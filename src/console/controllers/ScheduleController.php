<?php

namespace yiicom\console\controllers;

use Yii;
use yii\helpers\Console;
use yii\console\ExitCode;
use yii\console\Controller;
use yii\db\Expression;
use yiicom\common\interfaces\ModelStatus;
use yiicom\common\schedule\Scheduler;
use yiicom\common\models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Runs all schedule tasks
     * @return int
     * @throws \ReflectionException
     */
    public function actionRun()
    {
        $scheduleQuery = Schedule::find()
            ->where(['status' => ModelStatus::STATUS_ACTIVE])
            ->andWhere(['<', 'try', new Expression('`attempts`')])
            ->andWhere(['<=', 'startAt', date('Y-m-d H:i:s')])
            ->orderBy(['createdAt' => SORT_DESC]);

        if (! $scheduleQuery->count()) {
            Console::output(Console::ansiFormat("No schedule tasks", [Console::FG_GREEN]));

            return ExitCode::OK;
        }

        $sceduler = new Scheduler();

        foreach ($scheduleQuery->each() as $schedule) {
            /** @var Schedule $schedule */

            Console::output("Run schedule ID $schedule->id | TaskClass: $schedule->taskClass | startAt: $schedule->startAt");

            $sceduler->runTask($schedule);

            Console::output(Console::ansiFormat(
                "Status: {$schedule->statusesList()[$schedule->status]}\n",
                [$schedule->status === ModelStatus::STATUS_COMPLETE ? Console::FG_GREEN : Console::FG_YELLOW]
            ));
        }

        Console::output(Console::ansiFormat("All tasks processed", [Console::FG_GREEN]));

        return ExitCode::OK;
    }

    /**
     * Shows schedule task with errors
     */
    public function actionShowErrors()
    {
        $scheduleQuery = Schedule::find()
            ->where(['!=', 'status', ModelStatus::STATUS_ACTIVE])
            ->orWhere(['>=', 'try', new Expression('`attempts`')])
            ->orderBy(['createdAt' => SORT_DESC]);

        foreach ($scheduleQuery->each() as $schedule) {
            /** @var Schedule $schedule */
            Console::output(Console::ansiFormat(
                "ID: $schedule->id | TaskClass: $schedule->taskClass | Status: {$schedule->statusesList()[$schedule->status]} | Try: {$schedule->try}/{$schedule->attempts}",
                [Console::FG_YELLOW]
            ));
            Console::output("Result: {$schedule->result}\n");
        }
    }
    
}