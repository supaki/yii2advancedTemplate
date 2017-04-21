<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        //เพิ่มค่า authManager ของ mdmsoft yii2-admin
        'authManager' => [
           // 'class' =>  'yii\rbac\PhpManager',
            'class' =>  'yii\rbac\DbManager',
        ],
        //------------------------------------------
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
];
