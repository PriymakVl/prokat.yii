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
        'orderact' => ['class' => 'app\modules\orderact\Module',],
        'product' => ['class' => 'app\modules\product\Module',],
        'inventory' => ['class' => 'app\modules\inventory\Module',],
        'chain' => ['class' => 'app\modules\chain\Module',],
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
                //moduels
                'modules/list' => 'list-modules/list',
                //search
                'search/drawing/works' => 'search/search/drawing-works',
                'search/drawing/department' => 'search/search/drawing-department',
                'search/order' => 'search/search/order',
                'search/order/act' => 'search/search/order-act',
                'search/application' => 'search/search/application',
                'search/object/name' => 'search/search/object-name',
                'search/object/code' => 'search/search/object-code',
                //list
                'lists' => 'lists/list/all',
                'list' => 'lists/list/index',
                'list/content' => 'lists/list-content/list-content',
                'list/item/<action>' => 'lists/list-content/<action>',
                'list/<action>' => 'lists/list/<action>',
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
                //drawing danieli
                'drawing/danieli/form' => 'drawing/drawing-danieli/form',
                //admin
                'admin/excel/file/read' => 'admin/excel/read',
                'admin' => 'admin/mainadmin', 
                //standart
                'standard' => 'standard/standard',
                'standard/list' => 'standard/standard/list',                    
                'standard/content' => 'standard/standard/content',
                'standard/files' => 'standard/standardfile',
                //order content
                    'orders' => 'order/order/all',
                'order/content/<action>' => 'order/order-content/<action>',
                //order-list
                'order-list/list' => 'orderlist/order-list/list',
                'order-list/form' => 'orderlist/order-list/form',
                'order-list/active/set' => 'orderlist/order-list/set-active',
                'order-list' => 'orderlist/order-list',
                //order-list-content
                'order-list-content/add/order' => 'orderlist/order-list-content/add-order',
                'order-list-content/add/list/order' => 'orderlist/order-list-content/add-list-order',
                  //order-act
                'order/act/list' => 'orderact/order-act/list',
                'order/act/delete/list' => 'orderact/order-act/delete-list',
                'order/act/delete' => 'orderact/order-act/delete',
                'order/act/form' => 'orderact/order-act/form',
                'order/act/registr' => 'orderact/order-act/registration',
                'order/act/edit/state' => 'orderact/order-act/edit-state',
                'order/act/active/set' => 'orderact/order-act/set-active',
                'order/act' => 'orderact/order-act',
                'orderact/list/file/save' => 'orderact/order-act-list-excel',
                'order/act/show/filters' => 'orderact/order-act/show-filters',
                //order-act-content
                'order/act/content/delete' => 'orderact/order-act-content/delete',               
                'order/act/content/form' => 'orderact/order-act-content/form',                              
                'order/act/content/list' => 'orderact/order-act-content/list',
                //order
                //'order/form/area/equipment' => 'order/order/get-equipment-for-form',
                'order/list/file/save' => 'order/order-list-excel-create',
                'order/title/sheet/print' => 'order/order-title-sheet-create',
                'order/content/sheet/print' => 'order/order-content-sheet-create',
                'order/blank/print' => 'order/order-blank-sheet-create',
                'order/active/set' => 'order/order/set-active',
                'order/active/get' => 'order/order/get-active',
                'order/show/filters' => 'order/order/show-filters',
                'order' => 'order/order',
                'order/<action>' => 'order/order/<action>',
                //object specification
                'object/specification/main' => 'objects/object-specification/main',
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
                'object/drawing/code/update' => 'objects/object-drawing/set-code-object',
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
                //equipment
                'equipment/list' => 'equipments/equipment/list',
                'equipment/form' => 'equipments/equipment/form',
                'equipment/delete' => 'equipments/equipment/delete',
                'equipment/equipments/get/ajax' => 'equipments/equipment/get-equipments-ajax',
                'equipment/unitsequipment/get/ajax' => 'equipments/equipment/get-units-equipment-ajax',
                //equipment group
                'equipment/group/list' => 'equipments/equipment-group/list',
                'equipment/group/subgroups/get/ajax' => 'equipments/equipment-group/get-subgroups-ajax',
                'equipment/group/subgroupunits/get/ajax' => 'equipments/equipment-group/get-subgroup-units-ajax',
                'equipment/group/form' => 'equipments/equipment-group/form',
                'equipment/group/delete' => 'equipments/equipment-group/delete',
                //product
                'product/manufactured' => 'product/product/manufactured',
                'product/list' => 'product/product/list',
                'product' => 'product/product',
                //inventory
                'inventory/list' => 'inventory/inventory/list',
                'inventory/delete' => 'inventory/inventory/delete',
                'inventory/form' => 'inventory/inventory/form',
                'inventory' => 'inventory/inventory',
                //chains
                'chain/list' => 'chain/chain/list',
                'chain/iso/list' => 'chain/chain-iso/list',
                'chain' => 'chain/chain',
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
