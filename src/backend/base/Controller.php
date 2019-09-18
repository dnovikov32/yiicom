<?php

namespace modules\commerce\backend\base;

use yii\filters\AccessControl;

class Controller extends \modules\commerce\common\base\Controller
{
	public function init()
	{
		$this->layout = '@modules/commerce/backend/views/layouts/main';
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
