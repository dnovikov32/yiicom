<?php

namespace modules\commerce\backend\base;

class Model extends \modules\commerce\common\base\Model
{
	/**
	 * Сортирует и добавляеи новые модели в соответствии с позициями в форме
	 * @param object $multiModels - предыдущее состояние моделей
	 * @param array $data - POST данные формы
	 * @param string $formName - имя модели
	 * @return boolean|object -
	 */
	public static function createMultiple($multiModels, $data, $formName = null)
	{
		if(!$data) {
			return $multiModels;
		}

		if($formName === null) {
            /* @var $first Model */
            $first = reset($multiModels);
            if($first === false) {
                return false;
            }
            $formName = $first->formName();
			$className = '\\'.$first->className();
        }

		if(!isset($data[$formName])) {
			return $multiModels;
		}

		$indexes = array_keys($data[$formName]);

		$models = [];
		foreach($indexes as $index) {
			if(isset($multiModels[$index])) {
				$models[$index] = $multiModels[$index];
			} else {
				$models[$index] = new $className;
			}
		}

		return $models;
	}

}