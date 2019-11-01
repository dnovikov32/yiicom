####Common Yiicom module

Base Yiicom module contains:

Backend: Vuejs admin application with json REST api

Frontend: classic server side rendering with Vuejs in individual components 


* Yiicom admin panel 
* AdminUser
* LoginForm

####Install
**app/backend/config/main.php**
```php
// Enable backend routes
'modules' => [
    ...
    'yiicom' => [
        'class' => yiicom\backend\Module::class,
    ],
],

'components' => [
    ...
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'enableStrictParsing' => true,
        'rules' => [
            '/' => 'yiicom/main/default',
            '<module:\w+>/<controller:\w+>/<action:\w+>' => 'admin/main/default',
            '<module:\w+>/api/v1/<controller:\w+>/<action:[\w-]+>' => '<module>/api/v1/<controller>/<action>',
        ],
    ],
    // Templates override
    'view' => [
        'theme' => [
            'pathMap' => [
                '@yiicom' => '@app/themes/yiicom',
            ]
        ]
    ],

],

```
**app/console/config/main.php**
```php
// Enable module migrations 
'params' => [
    ...
    'yii.migrations' => [
        '@yiicom/migrations',
    ],
],
```

Run migrations to create **admin_users** table 
```bash
php yii migrate
```
