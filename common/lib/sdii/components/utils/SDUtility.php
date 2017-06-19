<?php

namespace common\lib\sdii\components\utils;

use yii\helpers\VarDumper;

/**
 * SDUtility class file UTF-8
 * @author SDII <iencoded@gmail.com>
 * @copyright Copyright &copy; 2015 AppXQ
 * @license http://www.appxq.com/license/
 * @version 1.0.0 Date: 7 ต.ค. 2558 10:22:22
 * @link http://www.appxq.com/
 * @example 
 */
class SDUtility {

	public static function strArray2String($arry) {
		$str = '';
		if ($arry !== '') {
			$value = eval("return $arry;");

			if (is_array($value)) {
				$str = @serialize($value);
			} else {
				$str = '';
			}
		}
		return $str;
	}

	public static function string2strArray($str) {
		$arry = @unserialize($str);
		if (is_array($arry)) {
			return VarDumper::export($arry);
		}
		return NULL;
	}

	public static function string2Array($str) {
		$arry = @unserialize($str);
		if (is_array($arry)) {
			return $arry;
		}
		return [];
	}
	
	public static function array2String($arry) {
		$str = '';
		if (is_array($arry)) {
		    $str = @serialize($arry);
		} else {
		    $str = '';
		}
		return $str;
	}
	
	public static function checkboxInput($index, $label, $name, $checked, $value) {
	    return \yii\helpers\Html::tag('div', \yii\helpers\Html::checkbox($name, $checked, [
                    'value' => $value,
                    'label' => \yii\helpers\Html::encode($label),
                ]), ['class'=>'checkbox']);
	}
	
}
