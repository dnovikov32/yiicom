<?php

namespace yiicom\backend;

use Yii;
use yiicom\common\models\ActiveRecord;

class Module extends \yiicom\common\Module
{
    /**
     * Return module settings for backend vue application
     * @return array
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
}