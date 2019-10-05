<?php

use yii\web\View;
use yii\helpers\Html;
use yiicom\commerce\backend\assets\CommerceAsset;
//use modules\pages\backend\assets\CommercePagesAsset;
//use modules\files\backend\assets\CommerceFilesAsset;
//use modules\catalog\backend\assets\CommerceCatalogAsset;

/**
 * @var View $this
 * @var string $content
 */

CommerceAsset::register($this);

// TODO: move to theme?
//$this->registerAssetBundle(CommercePagesAsset::class);
//$this->registerAssetBundle(CommerceFilesAsset::class);
//$this->registerAssetBundle(CommerceCatalogAsset::class);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?php echo \Yii::$app->language; ?>">
<head>
    <meta charset="<?php echo \Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php echo Html::csrfMetaTags(); ?>
    <title><?php echo Html::encode($this->title); ?></title>
    <?php echo $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>

    <div id="app"></div>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
