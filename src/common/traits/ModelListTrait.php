<?php

namespace yiicom\commerce\common\traits;

trait ModelListTrait
{
    /**
     * Returns [key => title] array of all models
     * @param string $key Array key
     * @param string $title Array value
     * @param string $order Order By column
     * @return array
     */
    public function getList(string $key = 'id', string $title = 'title', string $order = '')
    {
        $order = $order ? $order : $title;

        return static::find()
            ->select([$title, $key])
            ->orderBy($order)
            ->indexBy($key)
            ->column();
    }
}