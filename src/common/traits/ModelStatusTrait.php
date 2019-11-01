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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns model statuses list array
     * @return array
     */
    public function statusesList()
    {
        return [
            ModelStatus::STATUS_ACTIVE => Yii::t('yiicom', 'Active'),
            ModelStatus::STATUS_INACTIVE => Yii::t('yiicom', 'Inactive'),
            ModelStatus::STATUS_SOFT_DELETE => Yii::t('yiicom', 'Deleted'),
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