<?php

namespace yiicom\backend;

use Yii;
use yiicom\common\models\ActiveRecord;

class Module extends \yiicom\common\Module
{
    /**
     * @inheritDoc
     */
    public function settings()
    {
        $settings = [
            'id' => Yii::$app->id,
            'backendWeb' => getenv('BACKEND_WEB'),
            'frontendWeb' => getenv('FRONTEND_WEB'),
            'statusesList' => (new ActiveRecord)->statusesList(),
        ];


        return $settings;
    }

    /**
     * @inheritDoc
     */
    public function adminMenu()
    {
        return [
            'label' => 'Главная',
            'icon' => 'fa fa-chart-bar',
            'url' => '/',
        ];
    }
}