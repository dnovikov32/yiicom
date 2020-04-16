<?php

namespace yiicom\common\traits;

use Yii;
use yiicom\common\interfaces\ModelStatus;

/**
 * @property integer $status
 */
trait ModelStatusTrait
{
    /**
     * @return int
     */
    public function getStatus(): int
    {
        return (int) $this->status;
    }

    /**
     * Returns model statuses list array
     * @return array
     */
    public function statusesList(): array
    {
        return [
            ModelStatus::STATUS_ACTIVE => Yii::t('yiicom', 'Active'),
            ModelStatus::STATUS_INACTIVE => Yii::t('yiicom', 'Inactive'),
            ModelStatus::STATUS_SOFT_DELETE => Yii::t('yiicom', 'Deleted'),
            ModelStatus::STATUS_PROCESS => Yii::t('yiicom', 'Process'),
            ModelStatus::STATUS_COMPLETE => Yii::t('yiicom', 'Complete'),
            ModelStatus::STATUS_ERROR => Yii::t('yiicom', 'Error'),
        ];
    }

    /**
     * @return array
     */
    public function statusesOptions(): array
    {
        return array_keys($this->statusesList());
    }
}