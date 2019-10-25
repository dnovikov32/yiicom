# yii-commerce


Enable module migrations in console/config/main.php
```php 
[
    ...
    'params' => [
        ...
        'yii.migrations' => [
            '@yiicom/commerce/migrations',
        ],
    ],
    ...
]
```

Run migrations to create **admin_users** table 
```bash
php yii migrate
```