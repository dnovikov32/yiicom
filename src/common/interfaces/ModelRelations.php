<?php

namespace yiicom\commerce\common\interfaces;

/**
 * Use with EntityRelationsTrait
 */
interface ModelRelations
{
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