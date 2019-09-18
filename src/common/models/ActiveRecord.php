<?php

namespace modules\commerce\common\models;

use modules\commerce\common\interfaces\ModelList;
use modules\commerce\common\interfaces\ModelStatus;
use modules\commerce\common\interfaces\ModelRelations;
use modules\commerce\common\traits\ModelListTrait;
use modules\commerce\common\traits\ModelStatusTrait;
use modules\commerce\common\traits\ModelRelationsTrait;

/**
 * @inheritdoc
 *
 * @property integer $id
 */
class ActiveRecord extends \yii\db\ActiveRecord implements ModelStatus, ModelList, ModelRelations
{
    use ModelStatusTrait, ModelListTrait, ModelRelationsTrait;

}
