<?php
namespace common\lib\sdii\widgets;
/**
 * SDProvince class file UTF-8
 * @author SDII <iencoded@gmail.com>
 * @copyright Copyright &copy; 2015 AppXQ
 * @license http://www.appxq.com/license/
 * @version 1.0.0 Date: 25 พ.ย. 2558 13:08:20
 * @link http://www.appxq.com/
 * @example 
 */
use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\InputWidget;
use backend\modules\ezforms\models\EzformFields;
use common\lib\sdii\assets\ProvinceAsset;
use kartik\depdrop\DepDrop;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\modules\ezforms\components\EzformQuery;
use yii\web\JsExpression;

class SDMap extends InputWidget {

    public function init() {
	parent::init();
	
    }

    public function run()
    {
	
	$field = $this->options['field'];
	
	$dataLat = EzformFields::find()->where(['ezf_field_sub_id'=>$field->ezf_field_id])
            ->andWhere(['ezf_field_label'=>1])
	    ->andWhere(['ezf_field_type'=>21])
            ->One();
        $dataLng = EzformFields::find()->where(['ezf_field_sub_id'=>$field->ezf_field_id])
            ->andWhere(['ezf_field_label'=>2])
	    ->andWhere(['ezf_field_type'=>21])	
            ->One();
        
	$inputLatID;
	$inputLngID;
	$inputLatValue;
	$inputLngValue;
	
	if ($this->hasModel()) {
            $inputLatID = Html::getInputId($this->model, $dataLat["ezf_field_name"]);
	    $inputLngID = Html::getInputId($this->model, $dataLng["ezf_field_name"]);
	    $inputLatValue = Html::getAttributeValue($this->model, $dataLat["ezf_field_name"]);
	    $inputLngValue = Html::getAttributeValue($this->model, $dataLng["ezf_field_name"]);
        }

		echo ((string)$this->options['options_custom']['rstat']=='annotated') ?  '<code>'.$dataLat["ezf_field_name"].'</code>, ' : null;
		echo ((string)$this->options['options_custom']['rstat']=='annotated') ?  '<code>'.$dataLng["ezf_field_name"].'</code>' : null;

		echo MapInput::widget([
	    'lat'=>$inputLatID,
	    'lng'=>$inputLngID,
	    'latValue'=>$inputLatValue,
	    'lngValue'=>$inputLngValue,
	]);//
	//$this->registerClientScript();
	
        if ($this->hasModel()) {
            echo Html::activeHiddenInput($this->model, $dataLat["ezf_field_name"]);
	    	echo Html::activeHiddenInput($this->model, $dataLng["ezf_field_name"]);
        } 
	
    }
    
    public function registerClientScript() {
	$view = $this->getView();
    }
    
}
