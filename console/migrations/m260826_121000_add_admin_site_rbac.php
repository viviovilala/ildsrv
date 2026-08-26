<?php

namespace console\migrations;

use yii\db\Migration;
use yii\db\Query;

/**
 * Grants the administrator only the backend site actions used after login.
 */
class m260826_121000_add_admin_site_rbac extends Migration
{
    private const ADMIN_ROLE = 'admin';

    private const ADMIN_ROUTES = [
        '/site/index',
        '/site/logout',
    ];

    public function safeUp()
    {
        $time = time();

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
    }

    public function safeDown()
    {
        echo "RBAC permissions are intentionally preserved to avoid revoking active administrator access.\n";

        return false;
    }
}
