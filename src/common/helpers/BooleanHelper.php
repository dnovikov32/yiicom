<?php

namespace yiicom\common\helpers;

class BooleanHelper
{
    const STATUS_YES = true;
    const STATUS_NO = false;

    /**
     * @return array
     */
    public function statusesList()
    {
        return [
            static::STATUS_YES => 'Да',
            static::STATUS_NO => 'Нет'
        ];
    }

    /**
     * @return array
     */
    public function statusesOptions()
    {
        return array_keys($this->statusesList());
    }
}