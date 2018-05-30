<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'language' =>'zh-CN',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\UserModel',
            'enableAutoLogin' => true,
        ],

      'urlManager'=>[

        'enablePrettyUrl'=>true,//对url进行美化 
        'showScriptName'=>false,//隐藏index.php   

        'suffix'=>'.jsp',//后缀 (需要更改params中的重定向伪静态)

      ],
      //语言包配置
       'i18n'=>[
            'translations'=>[
              '*'=>[
              'class'=>'yii\i18n\PhpMessageSource',
              'fileMap'=>[
                'common'=>'common.php',

            ],
          ]
        ],
       ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
