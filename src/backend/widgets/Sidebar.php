<?php

namespace modules\commerce\backend\widgets;

use Yii;
use yii\base\Widget;
use yii\bootstrap4\Html;
use modules\commerce\common\Module;

/**
 * Admin modules menu
 */
class Sidebar extends Widget
{
    public function run()
    {
        return $this->render('sidebar', [
            'items' => $this->items(),
        ]);
    }

    /**
     * @return array Returns items array for yii\bootstrap4\Nav widget
     */
    private function items()
    {
        $navItems = [];

        foreach (Yii::$app->getModules() as $id => $module) {
            if (is_array($module)) {
                $module = Yii::$app->getModule($id);
            }

            /* @var Module $module */
            if ($module instanceof Module && method_exists($module, 'getAdminMenu')) {
                $moduleMenu = $module->getAdminMenu();

                if ($moduleMenu == false) {
                    continue;
                }

                $navItem = $this->item($moduleMenu);

                if (isset($moduleMenu['items'])) {
                    $navItem['items'] = [];

                    foreach ($moduleMenu['items'] as $moduleSubMenu) {
                        $navItem['items'][] = $this->item($moduleSubMenu);
                    }
                }

                $navItems[] = $navItem;
            }
        }

        return $navItems;
    }

    /**
     * @param array $menu Returns item data array
     * @return array
     */
    private function item(array $menu)
    {
        $item = [
            'label' => $menu['label'],
            'url' => $menu['url'],
        ];

        if (isset($menu['icon'])) {
            $item['label'] = Html::tag('i', '', ['class' => $menu['icon']]) . $item['label'];
        }

        return $item;
    }
}
