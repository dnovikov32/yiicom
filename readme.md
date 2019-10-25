####Common Yii2 Commerce module

Base Yii2 Commerce module contains:

Backend: Vuejs admin application with json REST api

Frontend: classic server side rendering with Vuejs in individual components 


* /admin 
* AdminUser
* LoginForm

####Install
To enable backend routes add to **app/backend/config/main.php**
```php
'modules' => [
    ...
    'admin' => [
        'class' => yiicom\commerce\backend\Module::class,
    ],
],

'components' => [
    ...
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'enableStrictParsing' => true,
        'rules' => [
            '/' => 'admin/main/index',
            '<module:\w+>/<controller:\w+>/<action:\w+>' => 'admin/main/index',
            '<module:\w+>/api/v1/<controller:\w+>/<action:[\w-]+>' => '<module>/api/v1/<controller>/<action>',
        ],
    ],
],



```
Enable module migrations in **console/config/main.php**
```php
'params' => [
    ...
    'yii.migrations' => [
        '@yiicom/commerce/migrations',
    ],
],
```

Run migrations to create **admin_users** table 
```bash
php yii migrate
```

#### Routes
* /admin
* /admin/index


Based on Yz2 and Marketing Solution Loyalty Program 
extensions for Yii2 Framework 

https://github.com/omnilight/yz2 

Started by Pavel Agalecky

