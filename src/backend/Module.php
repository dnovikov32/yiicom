<?php

namespace yiicom\backend;

use yiicom\common\models\ActiveRecord;

class Module extends \yiicom\common\Module
{
    /**
     * Return module settings for backend vue application
     * @return array
     */
    public function settings()
    {
        $settings['backendWeb'] = getenv('BACKEND_WEB');
        $settings['frontendWeb'] = getenv('FRONTEND_WEB');

        $settings['statusesList'] = (new ActiveRecord)->statusesList();

        return $settings;
    }
}