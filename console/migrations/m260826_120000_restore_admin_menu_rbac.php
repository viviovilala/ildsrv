<?php

namespace console\migrations;

use yii\db\Migration;
use yii\db\Query;

/**
 * Restores route permissions required by the local administrator menu.
 */
class m260826_120000_restore_admin_menu_rbac extends Migration
{
    private const ADMIN_ROLE = 'admin';

    private const ADMIN_ROUTES = [
        '/peraturan/*',
        '/catatan-verifikasi/*',
        '/circulation/*',
        '/berita/*',
        '/laporan/*',
        '/tipe-dokumen/*',
        '/admin/*',
        '/visitor-report/*',
        '/survey-kepuasan/*',
    ];

    public function safeUp()
    {
        $time = time();
        $roleExists = (new Query())
            ->from('{{%auth_item}}')
            ->where(['name' => self::ADMIN_ROLE, 'type' => 1])
            ->exists($this->db);

        if (!$roleExists) {
            $this->insert('{{%auth_item}}', [
                'name' => self::ADMIN_ROLE,
                'type' => 1,
                'description' => 'Local administrator role',
                'created_at' => $time,
                'updated_at' => $time,
            ]);
        }

        foreach (self::ADMIN_ROUTES as $route) {
            $permissionExists = (new Query())
                ->from('{{%auth_item}}')
                ->where(['name' => $route])
                ->exists($this->db);

            if (!$permissionExists) {
                $this->insert('{{%auth_item}}', [
                    'name' => $route,
                    'type' => 2,
                    'description' => 'Administrator access to ' . $route,
                    'created_at' => $time,
                    'updated_at' => $time,
                ]);
            }

            $assignmentExists = (new Query())
                ->from('{{%auth_item_child}}')
                ->where(['parent' => self::ADMIN_ROLE, 'child' => $route])
                ->exists($this->db);

            if (!$assignmentExists) {
                $this->insert('{{%auth_item_child}}', [
                    'parent' => self::ADMIN_ROLE,
                    'child' => $route,
                ]);
            }
        }

        $adminUserId = (new Query())
            ->select('id')
            ->from('{{%user}}')
            ->where(['username' => 'admin'])
            ->scalar($this->db);

        if ($adminUserId !== false && $adminUserId !== null) {
            $hasRole = (new Query())
                ->from('{{%auth_assignment}}')
                ->where(['user_id' => (string) $adminUserId])
                ->exists($this->db);

            if (!$hasRole) {
                $this->insert('{{%auth_assignment}}', [
                    'item_name' => self::ADMIN_ROLE,
                    'user_id' => (string) $adminUserId,
                    'created_at' => $time,
                ]);
            }
        }
    }

    public function safeDown()
    {
        echo "RBAC permissions are intentionally preserved to avoid revoking active administrator access.\n";

        return false;
    }
}
