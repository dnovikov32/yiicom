<?php

namespace modules\commerce\backend\controllers;

use modules\commerce\backend\base\Controller;

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
