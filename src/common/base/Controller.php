<?php

namespace modules\commerce\common\base;

use modules\commerce\common\traits\ModelTrait;

class Controller extends \yii\web\Controller
{
    use ModelTrait;

	public function actions()
	{
		return [
			'error' => [
				'class' => \yii\web\ErrorAction::class,
			]
		];
	}
}
