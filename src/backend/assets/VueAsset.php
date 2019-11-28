<?php

namespace yiicom\backend\assets;

use yii\web\AssetBundle;

/**
 * @inheritdoc
 * TODO: not necessary?
 */
class VueAsset extends AssetBundle
{
    public $sourcePath = '@vendor/npm-asset/vue/dist';

    public $js = [
        ('dev' === YII_ENV) ? 'vue.js' : 'vue.min.js',
    ];
}
