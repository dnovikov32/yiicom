<?php

use yii\web\View;
use yii\helpers\Html;

// TODO: make default admin layout
/**
 * @var View $this
 * @var string $content
 */

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

    <div id="app">Yiicom default layout/main template</div>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
