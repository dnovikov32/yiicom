<?php

namespace yiicom\commerce\backend\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;
use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use rmrevin\yii\fontawesome\AssetBundle as FontawesomeAsset;
use yiicom\commerce\backend\assets\ckeditor\CKEditorAsset;

/**
 * @inheritdoc
 */
class CommerceAsset extends AssetBundle
{
//    public $sourcePath = '@vendor/yiicom/yii-commerce/src/backend/assets/dist';
//
//    public $css = [
//		'css/yii.commerce.css',
//    ];
//
//    public $js = [
//		'js/yii.commerce.js',
//    ];

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
        FontawesomeAsset::class,
        VueAsset::class,
        CKEditorAsset::class,
    ];
}
