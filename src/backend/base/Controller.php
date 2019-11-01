<?php

namespace yiicom\backend\base;

use yii\filters\AccessControl;

class Controller extends \yiicom\common\base\Controller
{
	public function init()
	{
		$this->layout = '@yiicom/commerce/backend/views/layouts/main';
	}

//	public function behaviors()
//	{
//		return [
//			'access' => [
//				'class' => AccessControl::class,
//				'rules' =>  [
//					[
//						'actions' => ['login', 'error'],
//						'allow' => true
//					],
//					[
//						'allow' => true,
//						'roles' => ['@']
//					],
//				]
//			]
//		];
//	}
}
