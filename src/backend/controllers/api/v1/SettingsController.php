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
        $adminMenu = [];

        foreach (Yii::$app->getModules() as $id => $module) {
            if (is_array($module)) {
                $module = Yii::$app->getModule($id);
            }

            /* @var Module $module */
            if (! $module instanceof Module) {
                continue;
            }

            if (method_exists($module, 'settings')) {
                $settings = array_merge($settings, $module->settings());
            }

            if (method_exists($module, 'adminMenu')) {
                $moduleAdminMenu = $module->adminMenu();
                if ($moduleAdminMenu) {
                    $adminMenu = array_merge($adminMenu, [$id => $moduleAdminMenu]);
                }
            }
        }

        $settings['adminMenu'] = $adminMenu;

        return $settings;
    }
}