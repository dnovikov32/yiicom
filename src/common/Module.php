<?php

namespace yiicom\common;

use Yii;
use yii\i18n\PhpMessageSource;

class Module extends \yii\base\Module
{
//    public function init()
//    {
//        parent::init();
//
//        Yii::$app->i18n->translations['yiicom'] = [
//            'class' => PhpMessageSource::class,
//            'basePath' => '@yiicom/common/messages',
//            'sourceLanguage' => 'en-US',
//        ];
//    }

    /**
     * Return module settings for backend vue application
     * @return array
     */
    public function settings()
    {
        return [];
    }

    /**
     * Returns menu items for administration panel in the following form:
     * ~~~
     * [
     *     'label' => 'Group Title',
     *     'icon' => 'icon',
     *'     url' => '/admin/main/index',
     *     'items' => [
     *         [
     *             'label' => 'Item title',
     *             'icon' => 'icon',
     *             'url' => '/relative/route',
     *         ],
     *     ],
     * ]
     * ~~~
     * @return array
     */
    public function adminMenu()
    {
        return [];
    }
    
    
}