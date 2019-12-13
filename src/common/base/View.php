<?php

namespace yiicom\common\base;

use Yii;

class View extends \yii\web\View
{
    /**
     * Current url without GET params (like 'product/admin/index')
     * @var string
     */
    public $pathInfo;

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        $this->pathInfo = Yii::$app->getRequest()->getPathInfo();
    }

}