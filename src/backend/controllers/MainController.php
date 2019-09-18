<?php

namespace yiicom\commerce\backend\controllers;

use yiicom\commerce\backend\base\Controller;

class MainController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->renderContent('');
    }
}
