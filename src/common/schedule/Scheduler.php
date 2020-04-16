<?php

namespace yiicom\common\schedule;

use yii\base\Model;
use yii\helpers\Json;
use yiicom\common\models\Schedule;
use yiicom\common\interfaces\ModelStatus;
use yiicom\common\schedule\TaskInterface;

class Scheduler
{
    /**
     * @param TaskInterface $task
     * @param Model|null $model
     * @return Schedule
     */
    public function createSchedule(TaskInterface $task, Model $model = null): Schedule
    {
        $schedule = new Schedule();
        $schedule->loadDefaultValues();
        
        if ($model) {
            $schedule->modelClass = get_class($model);
            $schedule->modelId = $model->id ?? null;
        }

        $schedule->taskClass = get_class($task);
        $schedule->status = ModelStatus::STATUS_ACTIVE;
        $schedule->attempts = Schedule::DEFAULT_ATTEMPTS;
        $schedule->startAt = date('Y-m-d H:i:s');
        $schedule->context = $task->context();

        return $schedule;
    }

    /**
     * @param Schedule $schedule
     * @return bool
     */
    public function runTask(Schedule $schedule): bool
    {
        $schedule->updateAttributes(['status' => ModelStatus::STATUS_PROCESS]);
        $schedule->try++;

        try {
            $task = $this->createScheduleTask($schedule);
            $result = $task->run($schedule);

            $schedule->result = $result;
            $schedule->status = $result ? ModelStatus::STATUS_COMPLETE : ModelStatus::STATUS_ERROR;
        } catch (\Exception $e) {
            $schedule->result = $e->getMessage() ."\n" . $e->getTraceAsString();
            $schedule->status = ModelStatus::STATUS_ERROR;
        }

        return $schedule->save();
    }

    /**
     * @param Schedule $schedule
     * @return TaskInterface
     * @throws \ReflectionException
     */
    private function createScheduleTask(Schedule $schedule): TaskInterface
    {
        $class = new \ReflectionClass($schedule->taskClass);

        // Reordering arguments
        $context = [];
        foreach ($class->getConstructor()->getParameters() as $param) {
            $context[] = $schedule->context[$param->name];
        }

        return $class->newInstanceArgs($context);
    }
    
}