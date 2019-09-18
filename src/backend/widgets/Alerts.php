<?php

namespace yiicom\commerce\backend\widgets;

use Yii;
use yii\base\Widget;

class Alerts extends Widget
{
	private $_flashes;

	public function init()
	{
		parent::init();

		if (null === $this->_flashes) {
			$this->_flashes = Yii::$app->session->getAllFlashes();
		}
	}

	public function run()
	{
        return $this->render('alerts', ['alerts' => $this->_flashes]);
	}
}