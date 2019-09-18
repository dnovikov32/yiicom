<?php

namespace modules\commerce\common\interfaces;

interface ModelStatus
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_SOFT_DELETE = 8;

    /**
     * @return int
     */
    public function getStatus();

    /**
     * @return array
     */
    public function statusesList();


}