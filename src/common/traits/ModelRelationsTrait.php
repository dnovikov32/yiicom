<?php

namespace yiicom\commerce\common\traits;

use yii\base\Model;
use yii\helpers\ArrayHelper;

trait ModelRelationsTrait
{
    /**
     * Returns a list of relations that this model has.
     * Classes who use this trait may override this method to specify the relations they want to use.
     *
     * This method uses for multiple populate, load and validate in populateRelations(), loadAll() и validateAll()
     *
     * ```php
     *  'RelationName' => [
     *      'attribute' => 'url' // Form attribute name
     *      'class' => app\modules\product\models\ProductCategory // Relation model class
     *      'multiple' => true // To has many
     *      'populate' => false // Use to disabled populateRelations
     *  ]
     * ```
     * @todo: How to get all relations from model? Reflection is overkill
     * @link https://github.com/mootensai/yii2-relation-trait/blob/master/RelationTrait.php
     *
     * @return array
     */
    public function relations()
    {
        return [];
    }

    /**
     * Делает populateRelation() для всех пустых связанных моделей объявленых в методе relations()<br>
     * Чтобы не возикала ошибка "Call to a member function formName() on a non-object"<br>
     * при выводе поля пустой связи в шаблоне (echo $form->field($model->search, 'keywords')->label(false))
     */
    public function populateRelations()
    {
        foreach ($this->relations() as $relation) {
            if (isset($relation['populate']) && $relation['populate'] == false) {
                continue;
            }

            $class = is_array($relation) ? $relation['class'] : $relation;
            $multiple = (isset($relation['multiple']) && $relation['multiple'] === true);

            if ($this->{$relation['attribute']} === null) {
                $this->populateRelation($relation['attribute'], $multiple ? [new $class] : new $class);
            }
        }
    }

    /**
     * Loads data to main model and all relations
     * @link https://github.com/mootensai/yii2-relation-trait/blob/master/RelationTrait.php
     * @param array $data Request array data
     * @return boolean Return false only if no one model has been loaded
     */
    public function loadAll($data)
    {
        if (empty($data)) {
            return false;
        }

        $result = $this->load($data, '');

        foreach ($this->relations() as $relation) {
            $relAttr = $relation['attribute'];

            if (false === isset($data[$relAttr])) {
                continue;
            }

            $relData = $data[$relAttr];

            if (ArrayHelper::isAssociative($relData)) {
                $result = $this->$relAttr->load($relData, '') && $result;
            }

            // Related models with multiple values
            if (ArrayHelper::isIndexed($relData)) {
                $indexes = array_keys($relData);
                $models = [];

                foreach ($indexes as $index) {
                    if (isset($this->$relAttr[$index])) {
                        $models[$index] = $this->$relAttr[$index];
                    } else {
                        $models[$index] = new $relation['class'];
                    }

                    $result = $models[$index]->load($relData[$index], '') && $result;
                }

                $this->$relAttr = $models;
            }
        }

        return $result;
    }

    /**
     * Validates main model and relations
     * @return bool
     */
    public function validateAll()
    {
        $result = $this->validate();

        foreach ($this->relations() as $relation) {

            $relAttr = $relation['attribute'];
            $relModel = $this->$relAttr;

            if (ArrayHelper::isIndexed($relModel)) {
                foreach ($relModel as $model) {
                    /* @var Model $model */
                    $result = $model->validate() && $result;

                    if ($model->hasErrors()) {
                        $this->addErrors($model->getErrors());
                    }
                }
            } else {
                /* @var Model $relModel */
                $result = $relModel->validate() && $result;

                if ($relModel->hasErrors()) {
                    $this->addErrors($relModel->getErrors());
                }
            }
        }

        return $result;
    }
}