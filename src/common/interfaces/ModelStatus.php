<?php

namespace yiicom\common\interfaces;

interface ModelStatus
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_SOFT_DELETE = 5;

    const STATUS_PROCESS = 7;
    const STATUS_COMPLETE = 8;
    const STATUS_ERROR = 9;

    /**
     * @return int
     */
    public function getStatus(): int;

    /**
     * @return array
     */
    public function statusesList(): array;

}