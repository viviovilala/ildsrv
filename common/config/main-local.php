<?php

require __DIR__ . '/env.php';

return [
    'components' => [

        'db' => [
            'class' => 'yii\db\Connection',

            'dsn' =>
                'pgsql:host=' . getenv('DB_HOST') .
                ';port=' . getenv('DB_DATABASE_PORT') .
                ';dbname=' . getenv('DB_DATABASE'),

            'username' => getenv('DB_USER'),

            'password' => getenv('DB_PASSWORD'),

            'charset' => 'utf8',
        ],


        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,

            'viewPath' => '@common/mail',

            'transport' => [
                'dsn' => getenv('MAILER_DSN') ?: 'null://null',
            ],
        ],


        'user' => [
            'identityClass' => 'app\models\User',

            'enableAutoLogin' => false,
        ],

    ],
];