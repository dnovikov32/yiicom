<?php

namespace yiicom\commerce\backend\base;

use yii\rest\Controller;
use yii\filters\VerbFilter;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
//use yii\filters\RateLimiter;

// TODO: try RateLimiter
class ApiController extends Controller
{
    /**
     * // TODO: try to enable CsrfValidation
     * {@inheritdoc}
     */
//    public $enableCsrfValidation = false;

    /**
     * {@inheritdoc}
     */
	public function behaviors()
	{
		return array_merge(parent::behaviors(), [
            'verbFilter' => [
                'class' => VerbFilter::class,
                'actions' => [
                    '*' => ['GET', 'POST'],
                ],
            ],
            'authenticator' => [
                'class' => HttpBearerAuth::class,
            ],
			'access' => [
				'class' => AccessControl::class,
				'rules' =>  [
					[
						'allow' => true,
						'roles' => ['@']
					],
				]
			],
		]);
	}

}