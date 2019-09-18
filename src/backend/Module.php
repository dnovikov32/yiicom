<?php

namespace yiicom\commerce\backend;

class Module extends \yiicom\commerce\common\Module
{
    /**
     * Returns menu items for administration panel in the following form:
     * ~~~
     * [
     *     'label' => 'Group Title',
     *     'iconv' => 'icon',
     *     'items' => [
     *         [
     *             'route' => 'absolute/route', // Route (or URL if string)
     *             'authItem' => 'someItem', // Will be used to determine whether user has access to the menu
     *                                       // item. Otherwise information from the route will be used
     *             'label' => 'My title',
     *             'icon' => 'icon',
     *         ],
     *         [
     *              'class' => '\yz\module\AdminMenuItem', // Points to class that will return above array
     *              'parameter1' => '...'
     *         ]
     *     ],
     * ]
     * ~~~
     * @return array
     */
    public function getAdminMenu()
    {
        return [
            'label' => 'Главная',
            'url' => ['/admin/main/index'],
            'icon' => 'nav-icon fa fa-chart-bar',
        ];
    }
}