<?php

namespace yiicom\common\interfaces;

interface ModelList
{
    /**
     * @param string $key Array key
     * @param string $title Array value
     * @param string $order Order By column
     * @return array
     */
    public function getList(string $key, string $title, string $order);
}