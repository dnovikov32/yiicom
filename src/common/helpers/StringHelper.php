<?php

namespace modules\commerce\common\helpers;


class StringHelper extends \yii\helpers\StringHelper
{

    public static $months = ['январь', 'февраль', 'март', 'апрель', 'май', 'июнь', 'июль', 'август', 'сентябрь', 'октябрь', 'ноябрь', 'декабрь'];

	/**
	 * Возвращает название месяца на русском языке по его номеру
	 * @param integer $number - номер месяца
	 * @return string
	 */
	public static function getRusMonthName($number)
	{
		return self::$months[$number - 1];
	}

	/**
	 * Возвращает подстроку заданной длинны не обрезая слова
	 * @param string $text - полный текст
	 * @param integer $length - количество символов (по умолчанию 250)
	 * @return string
	 */
	public static function teaser($text, $length = 250)
	{
        $textClear = strip_tags($text);

		if(!$textClear) {
			return '';
		}

        if(mb_strlen($textClear, 'UTF-8') <= $length) {
            return $textClear;
        }


		$teaser = mb_substr($textClear, 0, $length, 'UTF-8');
		$pos = mb_strrpos($teaser, ' ', 'UTF-8');

		return mb_substr($teaser, 0, $pos, 'UTF-8'). '...';
	}

	/**
	 * Возвращает склонение для числительных
	 * @param integer $number - число
	 * @param array $words - варианты склонений
	 * @return string
	 */
	public static function numWord($number, $words) {
		$cases = array (2, 0, 1, 1, 1, 2);

		return $words[ ($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)] ];
	}

    public static function toNumber($value)
    {
        return preg_replace('/[^0-9]/', '', $value);
    }

}