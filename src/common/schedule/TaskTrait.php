<?php

namespace yiicom\common\schedule;

trait TaskTrait
{
    /**
     * Return schedule task context array for the Schedule model.
     * The name of the constructor argument is used as array key,
     * the public property of the task class of the same name is used as the value.
     * 
     * @return array|null
     * @throws \ReflectionException
     */
    public function context(): ?array
    {
        $class = new \ReflectionClass($this);
        $properties = array_column($class->getProperties(\ReflectionProperty::IS_PUBLIC), 'name');
        $args = array_column($class->getConstructor()->getParameters(), 'name');

        $context = [];

        foreach ($args as $arg) {
            if (in_array($arg, $properties)) {
                $context[$arg] = $this->{$arg};
            }
        }

        return $context ?: null;
    }
}