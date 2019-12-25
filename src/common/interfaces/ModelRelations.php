<?php

namespace yiicom\common\interfaces;

/**
 * Use with EntityRelationsTrait
 */
interface ModelRelations
{
    /**
     * Returns class name.
     * Is used for PageUrl modelClass field value and Vue backend application
     * @return string
     */
    public function getModelClass();

    /**
     * @return array
     */
    public function relations();

    /**
     * @return void
     */
    public function populateRelations();

    /**
     * @param array $data
     * @return boolean
     */
    public function loadAll($data);

    /**
     * @return bool
     */
    public function validateAll();
}