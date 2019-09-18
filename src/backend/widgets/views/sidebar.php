<?php

use yii\bootstrap4\Nav;

/**
 * @var array $items
 */

?>

<nav class="navbar sidebar navbar-dark bg-dark">

    <?= Nav::widget([
        'encodeLabels' => false,
        'activateParents' => true,
        'items' => $items,
    ]); ?>

</nav>

