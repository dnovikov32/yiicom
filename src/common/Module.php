<?php

namespace yiicom\common;

use Yii;
use yii\i18n\PhpMessageSource;

class Module extends \yii\base\Module
{
    public function init()
    {
        parent::init();

        Yii::$app->i18n->translations['yiicom'] = [
            'class' => PhpMessageSource::class,
            'basePath' => '@yiicom/common/messages',
            'sourceLanguage' => 'en-US',
        ];
    }
}