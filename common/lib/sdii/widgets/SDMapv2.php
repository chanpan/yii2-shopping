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
use yii\helpers\Html;
use yii\widgets\InputWidget;

class SDMapv2 extends InputWidget {

    public $fields;
    public $key;
    
    public function init() {
	parent::init();
    }

    public function run()
    {
	$inputLatID;
	$inputLngID;
	$inputLatValue;
	$inputLngValue;
	
        $fields;
        
        if(isset($this->fields)){
            foreach ($this->fields as $key => $value) {
                $fields[$value['label']] = $value['attribute'];
            }
        } else {
            return 'Fields not set.';
        }
        
	if ($this->hasModel()) {
            $inputLatID = Html::getInputId($this->model, $fields['lat']);
	    $inputLngID = Html::getInputId($this->model, $fields['lng']);
	    $inputLatValue = Html::getAttributeValue($this->model, $fields['lat']);
	    $inputLngValue = Html::getAttributeValue($this->model, $fields['lng']);
        }
        
	echo MapInput::widget([
            'key'=> $this->key,
	    'lat'=>$inputLatID,
	    'lng'=>$inputLngID,
	    'latValue'=>$inputLatValue,
	    'lngValue'=>$inputLngValue,
	]);
	
        if ($this->hasModel()) {
            echo Html::activeHiddenInput($this->model, $fields['lat']);
	    echo Html::activeHiddenInput($this->model, $fields['lng']);
        }
	
    }
    
}
