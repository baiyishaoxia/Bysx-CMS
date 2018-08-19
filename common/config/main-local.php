<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2mk',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true, //邮件发送配置，true表示生成邮件在本地，false表示真实发送
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.126.com',
                'username' => 'tzf2273465837@126.com',
                'password' => 'tzf2273465837@126.com',//如果是126邮箱，此处请填写授权码
                'port' => '25',
                'encryption' => 'tls',
            ],
        ],
    ],
];
