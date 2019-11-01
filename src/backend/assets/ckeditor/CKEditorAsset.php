<?php

namespace yiicom\backend\assets\ckeditor;

use yii\web\AssetBundle;

/**
 * @inheritdoc
 * TODO: can't add code mirror plug to npm CKEditor
 */
class CKEditorAsset extends AssetBundle
{
    public $sourcePath = '@yiicom/commerce/backend/assets/ckeditor/assets/ckeditor';

    public $js = [
        'ckeditor.js',
    ];

    public $depends = [
        \yii\web\JqueryAsset::class
    ];
}
