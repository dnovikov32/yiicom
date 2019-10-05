# yii-commerce
Base yii commerce module 


####Install
To enable backend routes add to **app/backend/config/main.php**
```php
'modules' => [
    ...
    'admin' => [
        'class' => yiicom\commerce\backend\Module::class,
    ],
],
```

Add module migrations to **app/console/config/main.php**
```php
'params' => [
    ...
    'yii.migrations' => [
        '@modules/commerce/migrations',
    ],
],
```

To create admin users table run yii migrate: 
```bash
php yii migrate
```

#### Routes
admin
admin/index



