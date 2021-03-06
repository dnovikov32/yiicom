####Common Yiicom module

Base Yiicom module contains:
- Backend: Vuejs admin application with json REST api
- Frontend: classic server side rendering with Vuejs in individual components 

Something taken from Yz2 extensions https://github.com/omnilight/yz2-admin


**Components**
- yiicom
    - Admin panel
    - LogingForm
    - AdminUser

- yiicom-content
    - Page
    - Category
    - Url
    
- yiicom-files

- yiicom-catalog
    - Category
    - Product
    - ProductCategory




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
            '<module:\w+>/api/v1/<controller:\w+>/<action:[\w-]+>' => '<module>/api/v1/<controller>/<action>',
            '<controller:\w+>/<action:\w+>' => '<controller>/<action>', // for elfinder route
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

    // Enable Elfinder
    'controllerMap' => [
        'elfinder' => [
            'class' => \mihaildev\elfinder\Controller::class,
            'access' => ['@'],
            'roots' => [
                [
                    'baseUrl' => '@backendWeb',
                    'basePath' => '@backendWebroot',
                    'path' => 'storage/uploads',
                    'name' => 'Файлы'
                ]
            ],
        ]
    ],

],

```
**app/console/config/main.php**
```php
// Enable console commands
'modules' => [
    ...
    'yiicom' => [
        'class' => \yiicom\console\Module::class,
    ],
],

// Enable module migrations 
'params' => [
    ...
    'yii.migrations' => [
        '@yiicom/migrations',
    ],
],
```

**app/console/config/schedule.php**
```php
// Add command to runs yiicom schedule tasks
$schedule->command('yiicom/schedule/run')->everyMinute();
```

Run migrations to create **commerce_admin_user** and **commerce_schedule** tables 
```bash
php yii migrate
```
