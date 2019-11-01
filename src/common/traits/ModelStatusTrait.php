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
            ModelStatus::STATUS_ACTIVE => Yii::t('commerce', 'Active'),
            ModelStatus::STATUS_INACTIVE => Yii::t('commerce', 'Inactive'),
            ModelStatus::STATUS_SOFT_DELETE => Yii::t('commerce', 'Deleted'),
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