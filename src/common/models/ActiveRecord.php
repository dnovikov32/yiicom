<?php

namespace yiicom\common\models;

use yiicom\common\interfaces\ModelList;
use yiicom\common\interfaces\ModelStatus;
use yiicom\common\interfaces\ModelRelations;
use yiicom\common\traits\ModelListTrait;
use yiicom\common\traits\ModelStatusTrait;
use yiicom\common\traits\ModelRelationsTrait;

/**
 * @inheritdoc
 *
 * @property integer $id
 */
class ActiveRecord extends \yii\db\ActiveRecord implements ModelStatus, ModelList, ModelRelations
{
    use ModelStatusTrait, ModelListTrait, ModelRelationsTrait;

}
