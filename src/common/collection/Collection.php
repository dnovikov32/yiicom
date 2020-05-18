<?php

namespace yiicom\common\collection;

use yii\base\Exception;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

class Collection
{
    /** @var ActiveQuery */
    private $query;

    /** @var array */
    private $fields = ['id', 'name'];

    /** @var array */
    private $order = ['name' => SORT_ASC];

    /**
     * @param string $class
     * @throws \ReflectionException
     */
    public function __construct(string $class)
    {
        $reflection = new \ReflectionClass($class);

        if (! $reflection->isSubclassOf(ActiveRecord::class)) {
            throw new Exception('Class must extends ActiveRecord');
        }

        $this->query = $reflection->name::find();
    }

    /**
     * @param array $fields
     * @return Collection
     */
    public function fields(array $fields = ['id', 'name']): Collection
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @param mixed $order
     * @return Collection
     */
    public function order($order = 'name'): Collection
    {
        if (! is_array($order)) {
            $order = [$order => SORT_ASC];
        }

        $this->order = $order;

        return $this;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return $this->query
            ->select($this->fields)
            ->orderBy($this->order)
            ->asArray()
            ->all();
    }
}
