<?php

namespace yiicom\commerce\common\models;

use yiicom\commerce\common\interfaces\ModelList;
use yiicom\commerce\common\interfaces\ModelStatus;
use yiicom\commerce\common\interfaces\ModelRelations;
use yiicom\commerce\common\traits\ModelListTrait;
use yiicom\commerce\common\traits\ModelStatusTrait;
use yiicom\commerce\common\traits\ModelRelationsTrait;

/**
 * @inheritdoc
 *
 * @property integer $id
 */
class ActiveRecord extends \yii\db\ActiveRecord implements ModelStatus, ModelList, ModelRelations
{
    use ModelStatusTrait, ModelListTrait, ModelRelationsTrait;

}
