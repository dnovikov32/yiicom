<?php

namespace yiicom\common\traits;

use Yii;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

trait ModelTrait
{
    /**
     * @param string $class
     * @param integer $id
     * @return ActiveRecord
     * @throws NotFoundHttpException
     */
    public function findModel(string $class, int $id)
    {
        /* @var ActiveRecord $class */
        $model = $class::findOne(['id' => $id]);

        if (! $model) {
            throw new NotFoundHttpException(Yii::t('app', 'Page not found'));
        }

        return $model;
    }

    /**
     * Experimental method
     * @param string $class
     * @param int|null $id
     * @param bool $new
     * @return ActiveRecord
     * @throws NotFoundHttpException
     */
    public function findOrNewModel(string $class, int $id = null, bool $new = true)
    {
        /* @var ActiveRecord $class */
        /* @var ActiveRecord $model */

        $model = $class::findOne(['id' => $id]);

        if (! $model) {
            if (! $new) {
                throw new NotFoundHttpException(Yii::t('app', 'Page not found'));
            }

            $model = new $class;
            $model->loadDefaultValues();
        }

        if (method_exists($model, 'populateRelations')) {
            $model->populateRelations();
        }

        return $model;
    }

}
