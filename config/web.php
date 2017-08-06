<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    //'language' => 'ru',
    'defaultRoute' => 'main/index',
    'modules' => [
        'lists' => ['class' => 'app\modules\lists\Module',],
        'drawing' => ['class' => 'app\modules\drawing\Module',],
        'admin' => ['class' => 'app\modules\admin\Module',],
        'standard' => ['class' => 'app\modules\standard\Module',],
        'order' => ['class' => 'app\modules\order\Module',],
        'search' => ['class' => 'app\modules\search\Module',],
        'objects' => ['class' => 'app\modules\objects\Module',],
        'employees' => ['class' => 'app\modules\employees\Module',],
        'equipments' => ['class' => 'app\modules\equipments\Module',],
         'letters' => ['class' => 'app\modules\letters\Module',],
        'applications' => ['class' => 'app\modules\applications\Module',],
        'orderlist' => ['class' => 'app\modules\orderlist\Module',],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ssddxxxccccc',
            'baseUrl' => '',
        ],
        'formatter' => [
            'dateFormat' => 'd.m.y',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //search
                'search/drawing/works' => 'search/search/drawing-works',
                'search/drawing/department' => 'search/search/drawing-department',
                'search/order' => 'search/search/order',
                'search/application' => 'search/search/application',
                'search' => 'search/search/code',
                //list
                'lists/update' => 'lists/list/update-all',
                'lists' => 'lists/list/all',
                'list/active' => 'lists/list',
                'list/content/update' => 'lists/content/form',
                'list/form' => 'lists/list/form',
                'list/item/add' => 'lists/list-content/add',
                'list/item/update' => 'lists/list-content/form',
                'list/item/delete' => 'lists/list-content/delete',
                //drawing department
                'drawing/department/list' => 'drawing/drawing-department/list',                
                'drawing/department/form' => 'drawing/drawing-department/form',                
                'drawing/department/delete' => 'drawing/drawing-department/delete',                
                'drawing/department/folder' => 'drawing/drawing-department/folder',                
                'drawing/department/set/parent' => 'drawing/drawing-department/set-parent',                
                'drawing/department' => 'drawing/drawing-department', 
                //drawing works and file
                'drawing/works/file/delete' => 'drawing/drawing-works-file/delete',
                'drawing/works/list' => 'drawing/drawing-works/list',  
                'drawing/works/file/form' => 'drawing/drawing-works-file/form',              
                'drawing/works/form' => 'drawing/drawing-works/form',                
                'drawing/works/delete' => 'drawing/drawing-works/delete',                
                'drawing/works/specification' => 'drawing/drawing-works/specification',                               
                'drawing/works/files' => 'drawing/drawing-works/files',                
                'drawing/works/set/parent' => 'drawing/drawing-works/set-parent',                
                'drawing/works' => 'drawing/drawing-works',
                //drawing standard
                'drawing/standard/danieli/form' => 'drawing/drawing-standard-danieli/form', 
                //admin
                'admin/excel/file/read' => 'admin/excel/read',
                'admin' => 'admin/mainadmin', 
                //standart
                'standard' => 'standard/standard',
                'standard/list' => 'standard/standard/list',                    
                'standard/content' => 'standard/standard/content',
                'standard/files' => 'standard/standardfile', 
                //order
                'order/list' => 'order/order/list',
                'order/form' => 'order/order/form',                   
                'order/work' => 'order/order/work',                   
                'order/form/area/equipment' => 'order/order/get-equipment-for-form',                   
                'order/delete' => 'order/order/delete',
                'order/list/file/save' => 'order/order-list-excel-create', 
                'order/title/sheet/print' => 'order/order-title-sheet-create',
                'order/content/sheet/print' => 'order/order-content-sheet-create', 
                'order/active/set' => 'order/order/set-active',
                'order/active/get' => 'order/order/get-active',                
                'order' => 'order/order', 
                'order/copy' => 'order/order/copy',
                //order content
                'order/content/list' => 'order/order-content/list',
                'order/content/form' => 'order/order-content/form',
                'order/content/item' => 'order/order-content',
                'order/content/item/delete' => 'order/order-content/delete-one',
                'order/content/item/add' => 'order/order-content/add-one',
                'order/content/list/add' => 'order/order-content/add-list',
                'order/content/list/set/parent' => 'order/order-content/set-parent',
                'order/content/delete/list' => 'order/order-content/delete-list',
                'order/content/item/file/add' => 'order/order-content/add-file',
                //order-list
                'order-list/list' => 'orderlist/order-list/list',
                'order-list/form' => 'orderlist/order-list/form',
                'order-list/active/set' => 'orderlist/order-list/set-active',
                'order-list' => 'orderlist/order-list',
                //object specification
                'object/specification/delete/list' => 'objects/object-specification/delete-list',
                'object/specification/copy/list' => 'objects/object-specification/copy-list',
                'object/specification/change/parent' => 'objects/object-specification/change-parent',
                'object/specification/danieli/file/form' => 'objects/object-specification/danieli-file-form',
                'object/specification/highlight/list' => 'objects/object-specification/highlight-list',
                'object/specification' => 'objects/object-specification',
                //object drawing 
                'object/drawing/note' => 'objects/object-drawing/note',
                'object/drawing/delete' => 'objects/object-drawing/delete', 
				'object/drawing/form/vendor' => 'objects/object-drawing/form-vendor',				
                'object/drawing/form' => 'objects/object-drawing/form',
                'object/drawing' => 'objects/object-drawing',
                'object/drawing/vendor/update' => 'objects/object-drawing/update-vendor',
                //object
                'object' => 'objects/object',                                    
                'object/form' => 'objects/object/form',                                    
                'object/copy' => 'objects/object/copy',
                'object/delete/one' => 'objects/object/delete-one', 
                'object-danieli-update' => 'objects/object-danieli-update', 
                'object/orders' => 'objects/object/orders',  
                //letter
                'letter/list' => 'letters/letter/list',
                'letter' => 'letters/letter',
                'letter/form' => 'letters/letter/form',
                'letter/delete' => 'letters/letter/delete', 
                //application 
                'application/list' => 'applications/application/list',
                'application/form' => 'applications/application/form',
                'application/print' => 'applications/application-sheet-create',  
                'application' => 'applications/application', 
                //application content   
                'application/content/list' => 'applications/application-content/list', 
				'application/content/form' => 'applications/application-content/form', 
                'application/content/item' => 'applications/application-content',   
								
            ],
        ],  
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
