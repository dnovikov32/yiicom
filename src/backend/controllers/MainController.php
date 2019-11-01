<?php

namespace yiicom\backend\controllers;

use yiicom\backend\base\Controller;

class MainController extends Controller
{
    /**
     * @return string
     */
    public function actionDefault()
    {
        return $this->renderContent('');
    }
}
