<?php

namespace common\models;

use Yii;
use yii\base\Model;

class MemberForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user;


    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function validatePassword($attribute, $params)
    {
        if ($this->hasErrors()) {
            return;
        }

        $user = $this->getUser();
        $username = $this->username;
        $cacheKey = "member_failed_logins_{$username}";
        $failedLogins = Yii::$app->cache->get($cacheKey) ?: 0;

        if ($user) {
            if ($user->suspended_until && strtotime($user->suspended_until) > time()) {
                $remaining = strtotime($user->suspended_until) - time();
                $minutesLeft = ceil($remaining / 60);
                $this->addError($attribute, "Akun ditangguhkan. Coba lagi dalam {$minutesLeft} menit.");
                return;
            }

            if (!$user->validatePassword($this->password)) {
                $failedLogins++;
                Yii::$app->cache->set($cacheKey, $failedLogins, 300);

                if ($failedLogins >= 3) {
                    $user->suspended_until = date('Y-m-d H:i:s', time() + 300);
                    $user->save(false);
                    Yii::$app->cache->delete($cacheKey);
                    $this->addError($attribute, "Akun ditangguhkan selama 5 menit karena salah login 3x berturut-turut.");
                } else {
                    $this->addError($attribute, "Kesalahan username atau password. Sisa percobaan login: " . (3 - $failedLogins));
                }
            } else {
                Yii::$app->cache->delete($cacheKey);
            }
        } else {
            $failedLogins++;
            Yii::$app->cache->set($cacheKey, $failedLogins, 300);
            $this->addError($attribute, "Kesalahan username atau password. Sisa percobaan login: " . (3 - $failedLogins));
        }
    }

    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Member::findByUsername($this->username);
        }

        return $this->_user;
    }
}
