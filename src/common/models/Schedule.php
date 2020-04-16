<?php

namespace yiicom\common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yiicom\common\interfaces\ModelStatus;
use yiicom\common\traits\ModelStatusTrait;

/**
 * @property integer $id
 * @property string $modelClass
 * @property integer $modelId
 * @property string $taskClass
 * @property integer $status
 * @property integer $attempts
 * @property integer $try
 * @property string $context
 * @property string $result
 * @property string $startAt
 * @property string $createdAt
 * @property string $updatedAt
 */
class Schedule extends ActiveRecord implements ModelStatus
{
    use ModelStatusTrait;

    const DEFAULT_ATTEMPTS = 3;

    /**
     * @inheritDoc
     */
	public static function tableName() {
		return '{{%commerce_schedule}}';
	}

    /**
     * @inheritDoc
     */
	public function rules()
	{
		return [
            ['modelClass', 'string', 'max' => 255],

            ['modelId', 'integer'],

            ['taskClass', 'required'],
            ['taskClass', 'string', 'max' => 255],

            ['status', 'in', 'range' => $this->statusesOptions()],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],

            ['attempts', 'required'],
            ['attempts', 'integer'],
            ['attempts', 'default', 'value' => self::DEFAULT_ATTEMPTS],

            ['try', 'integer'],
            ['try', 'default', 'value' => 0],

            ['context', 'safe'],

            ['result', 'safe'],

            ['startAt', 'required'],
            ['startAt', 'datetime', 'format' => 'php:Y-m-d H:i:s'],
		];
	}

    /**
     * @inheritDoc
     */
	public function attributeLabels()
	{
		return [
            'id' => Yii::t('yiicom', 'ID'),
            'modelClass' => Yii::t('yiicom', 'Model class'),
            'modelId' => Yii::t('yiicom', 'Model ID'),
            'taskClass' => Yii::t('yiicom', 'Task class'),
            'status' => Yii::t('yiicom', 'Status'),
            'attempts' => Yii::t('yiicom', 'Attempts'),
            'try' => Yii::t('yiicom', 'Try'),
            'context' => Yii::t('yiicom', 'Context'),
            'result' => Yii::t('yiicom', 'Result'),
            'startAt' => Yii::t('yiicom', 'Start datetime'),
            'createdAt' => Yii::t('yiicom', 'Created datetime'),
            'updatedAt' => Yii::t('yiicom', 'Updated datetime'),
		];
	}

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(),  [
            'Timestamp' => [
                'class' => TimestampBehavior::class,
                'value' => new Expression('NOW()'),
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt',
            ],
        ]);
    }
    /**
     * @inheritDoc
     */
    public function fields()
    {
        return [
            'id',
            'modelClass',
            'modelId',
            'taskClass',
            'status',
            'attempts',
            'try',
            'context',
            'result',
            'startAt'
        ];
    }

}