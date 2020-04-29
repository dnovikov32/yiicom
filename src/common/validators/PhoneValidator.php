<?php

namespace yiicom\common\validators;

use Yii;
use yii\validators\Validator;

class PhoneValidator extends Validator
{
	public function validateAttribute($model, $attribute)
	{
		$phone = preg_replace('/[^0-9]/', '', $model->{$attribute});

		// TODO: add phone number validator https://github.com/giggsey/libphonenumber-for-php
		if (strlen($phone) < 10) {
			$this->addError($model, $attribute, Yii::t('yiicom', 'Укажите корректный телефон'));
		}
	}
}