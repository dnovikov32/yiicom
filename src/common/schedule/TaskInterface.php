<?php

namespace yiicom\common\schedule;

use yiicom\common\models\Schedule;

interface TaskInterface
{
    /**
     * @return array|null
     */
    public function context(): ?array;

    /**
     * @param Schedule $schedule
     * @return bool
     */
    public function run(Schedule $schedule): bool;
}