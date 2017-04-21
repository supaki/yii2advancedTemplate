<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        //เรียกใช้โมดูล mdmsoft yii2-admin----------------
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'controllerMap' => [
                 'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'dektrium\user\models\User', 
                    //เรียกใช้โมเดล user ของ dektrium
                ]
            ],
        ],
        //---------------------------------------
        //
        //เรียกใช้โมดูล dektrium user-------------------
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableUnconfirmedLogin' => true,
            'confirmWithin' => 21600,
            'cost' => 12,
            'admins' => ['admin']
        ],
        //-------------------------------------
    ],
    'components' => [
        //กำหนดให้ใช้ dektrium user-------------------
        'user' => [
            //'identityClass' => 'app\models\User',//ของเดิม
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        //---------------------------------------------
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    //เพิ่มค่า as access ของ mdmsoft yii2-admin ให้อยู่ในระดับเดียวกับ components ด้วยค่าดังนี้
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //module, controller, action ที่อนุญาตให้ทำงานโดยไม่ต้องผ่านการตรวจสอบสิทธิ์
            'site/*',
            'admin/*',
            'some-controller/some-action',
        ]
    ],
    //-----------------------------------------------
    
    
    'params' => $params,
];
