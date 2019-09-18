<?php

namespace modules\commerce\backend\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;
use yii\bootstrap4\BootstrapAsset;
use yii\bootstrap4\BootstrapPluginAsset;
use rmrevin\yii\fontawesome\AssetBundle as FontawesomeAsset;
use modules\commerce\backend\assets\ckeditor\CKEditorAsset;

/**
 * @inheritdoc
 */
class CommerceAsset extends AssetBundle
{
    public $sourcePath = '@modules/commerce/backend/assets/dist';

    public $css = [
		'css/commerce.css',
    ];

    public $js = [
		'js/commerce.js',
    ];

    public $depends = [
        YiiAsset::class,
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
        FontawesomeAsset::class,
        VueAsset::class,
        CKEditorAsset::class,
    ];
}
