<?php

namespace yiicom\common\schedule;

use Yii;
use yiicom\common\models\Schedule;
use yiicom\common\schedule\TaskInterface;
use yiicom\common\schedule\TaskTrait;

class SendMailTask implements TaskInterface
{
    use TaskTrait;

    /** @var string */
    public $to;

    /** @var string */
    public $subject;

    /** @var string */
    public $body;

    public function __construct(string $to, string $subject, string $body)
    {
        $this->to = $to;
        $this->subject = $subject;
        $this->body = $body;
    }
    
    public function run(Schedule $schedule): bool
    {
        return Yii::$app->mailer->compose()
            ->setTo($this->to)
            ->setSubject($this->subject)
            ->setHtmlBody($this->body)
            ->send();
    }
}