<?php

namespace yiicom\backend\controllers\api\v1;

use Yii;
use yiicom\backend\base\ApiController;
use yiicom\common\Module;

class SettingsController extends ApiController
{
    /**
     * Returns yiicom modules settings for backend application
     * @return array
     */
    public function actionIndex()
    {
        $settings = [];

        foreach (Yii::$app->getModules() as $id => $module) {
            if (is_array($module)) {
                $module = Yii::$app->getModule($id);
            }

            /* @var Module $module */
            if ($module instanceof Module && method_exists($module, 'settings')) {
                $settings = array_merge($settings, $module->settings());
            }
        }

        return $settings;
    }
}