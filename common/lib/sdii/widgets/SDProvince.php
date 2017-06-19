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
use yii\helpers\VarDumper;
use yii\widgets\InputWidget;
use backend\modules\ezforms\models\EzformFields;
use common\lib\sdii\assets\ProvinceAsset;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use backend\modules\ezforms\components\EzformQuery;
use yii\web\JsExpression;

class SDProvince extends InputWidget {

    public $enable_tumbon = 0;
    
    public function init() {
	parent::init();
	
    }

    public function run()
    {
	
	$field = $this->options['field'];
	
	$dataProvince = EzformFields::find()->where(['ezf_field_sub_id'=>$field->ezf_field_id])
            ->andWhere(['ezf_field_label'=>1])
	    ->andWhere(['ezf_field_type'=>21])
            ->One();
        $dataAmphur = EzformFields::find()->where(['ezf_field_sub_id'=>$field->ezf_field_id])
            ->andWhere(['ezf_field_label'=>2])
	    ->andWhere(['ezf_field_type'=>21])	
            ->One();
        $dataTumbon = EzformFields::find()->where(['ezf_field_sub_id'=>$field->ezf_field_id])
            ->andWhere(['ezf_field_label'=>3])
	    ->andWhere(['ezf_field_type'=>21])	
            ->One();
    
	$itemsProvince = EzformQuery::getProvince();
	
	$inputProvinceID;
	$inputAmphurID;
	$inputTumbonID;
	$inputProvinceValue;
	$inputAmphurValue;
	$inputTumbonValue;
	
	if ($this->hasModel()) {
            $inputProvinceID = Html::getInputId($this->model, $dataProvince["ezf_field_name"]);
	    $inputAmphurID = Html::getInputId($this->model, $dataAmphur["ezf_field_name"]);
	    if($dataTumbon){
		$inputTumbonID = Html::getInputId($this->model, $dataTumbon["ezf_field_name"]);
		$inputTumbonValue = Html::getAttributeValue($this->model, $dataTumbon["ezf_field_name"]);
	    }
	    $inputProvinceValue = Html::getAttributeValue($this->model, $dataProvince["ezf_field_name"]);
	    $inputAmphurValue = Html::getAttributeValue($this->model, $dataAmphur["ezf_field_name"]);
        }
	$html = '<b>'.$field->ezf_field_label.'</b>';
	$html .= "<div class='row'><div class='col-md-3'>";
		$html .= ((string)$this->options['options_custom']['rstat']=='annotated') ?  '<code>'.$dataProvince["ezf_field_name"].'</code>' : null;
        $html .=  Select2::widget([
            'options' => ['placeholder' => 'จังหวัด','id'=>$this->id.'_'.$dataProvince["ezf_field_name"]],
            'data' => ArrayHelper::map($itemsProvince,'PROVINCE_CODE','PROVINCE_NAME'),
            //'model' =>$this->model,
            'name'=>$this->id.'_'.$dataProvince["ezf_field_name"],
	    'value' => $inputProvinceValue,
            'pluginOptions' => [
                'allowClear' => true,
//		'ajax' => [
//		    'url' => Url::to(['/ezforms/province/get-province']),
//		    'dataType' => 'json',
//		    'data' => new JsExpression('function(params) { return {q:params.term}; }')
//		],
		'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
		'templateResult' => new JsExpression('function(result) { return result.text; }'),
		'templateSelection' => new JsExpression('function (result) { return result.text; }'),
            ],
	    'pluginEvents' => [
		"select2:select" => "function(e) { $('#$inputProvinceID').val(e.params.data.id); $('#$inputAmphurID').val('');$('#$inputTumbonID').val(''); }",
		"select2:unselect" => "function() { $('#$inputProvinceID').val(''); $('#$inputAmphurID').val('');$('#$inputTumbonID').val(''); }"
	    ]
        ]);
	$html .= "</div>";
        $html .= "<div class='col-md-3'>";
		$html .= ((string)$this->options['options_custom']['rstat']=='annotated') ?  '<code>'.$dataAmphur["ezf_field_name"].'</code>' : null;
        $html .= DepDrop::widget([
            'type'=>  DepDrop::TYPE_SELECT2,
            'options'=>['id'=>$this->id.'_'.$dataAmphur["ezf_field_name"]],
            //'model'=>$this->model,
            'name'=>$this->id.'_'.$dataAmphur["ezf_field_name"],
	    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
            'pluginOptions'=>[
		'allowClear' => true,
                'depends'=>[$this->id.'_'.$dataProvince["ezf_field_name"]],
                'placeholder'=>'อำเภอ',
                'url'=>Url::to(['/ezforms/province/genamphur']),
		'params'=>[$inputAmphurID],
            ],
	    'pluginEvents' => [
		"select2:select" => "function(e) {  $('#$inputAmphurID').val(e.params.data.id); $('#$inputTumbonID').val(''); }",
		"select2:unselect" => "function() { $('#$inputAmphurID').val(''); $('#$inputTumbonID').val(''); }",
	    ]
        ]);
	
	$html .= "</div>";
        if(isset($dataTumbon)){
            $html .= "<div class='col-md-3'>";
			$html .= ((string)$this->options['options_custom']['rstat']=='annotated') ?  '<code>'.$dataTumbon["ezf_field_name"].'</code>' : null;
            $html .= DepDrop::widget([
                'type'=>  DepDrop::TYPE_SELECT2,
                //'model'=>$this->model,
                'name'=>$this->id.'_'.$dataTumbon["ezf_field_name"],
		'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                'pluginOptions'=>[
		    'allowClear' => true,
                    'depends'=>[$this->id.'_'.$dataProvince["ezf_field_name"],$this->id.'_'.$dataAmphur["ezf_field_name"]],
                    'placeholder'=>'ตำบล',
		    'initialize' => true,
		    'initDepends'=>[$this->id.'_'.$dataProvince["ezf_field_name"]],
                    'url'=>Url::to(['/ezforms/province/gentumbon']),
		    'params'=>[$inputTumbonID],
                ],
		'pluginEvents' => [
		    "select2:select" => "function(e) { $('#$inputTumbonID').val(e.params.data.id); }",
		    "select2:unselect" => "function() { $('#$inputTumbonID').val(''); }",
		]
            ]);
            $html .= "</div>";
        }
	
	$html .= "</div>";
	//$this->registerClientScript();
	//\yii\helpers\VarDumper::dump($dataProvince,10,true);
	
	echo $html;
	
        if ($this->hasModel()) {
            echo Html::activeHiddenInput($this->model, $dataProvince["ezf_field_name"]);
	    echo Html::activeHiddenInput($this->model, $dataAmphur["ezf_field_name"]);
	    if($dataTumbon){
		echo Html::activeHiddenInput($this->model, $dataTumbon["ezf_field_name"]);
	    }
	    
        } 
	
    }
    
    public function registerClientScript() {
	$view = $this->getView();
	ProvinceAsset::register($view);
	
    }
    
}
