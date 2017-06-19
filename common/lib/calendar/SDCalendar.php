<?php

namespace appxq\calendar;

use Yii;
use yii\helpers\Html;
use yii\jui\Widget;
use appxq\calendar\assets\CalendarAsset;
use yii\helpers\Json;

/**
 * SDCalendar class file UTF-8
 * @author SDII <iencoded@gmail.com>
 * @link http://www.appxq.com/
 * @copyright Copyright &copy; 2015 AppXQ
 * @license http://www.appxq.com/license/
 * @package appxq\calendar
 * @version 2.0.0 Date: Sep 5, 2015 3:18:34 PM
 * @example 
 */
class SDCalendar extends Widget {

	/**
	 * รูปแบบการแสดงผล
	 * @var string
	 */
	//public $view;
	
	/**
	 * popup Id in html 
	 * @var string
	 */
	public $popupId;
	public $loadFunc;
	public $linkFunc;
	/**
	 * add method function name
	 * @var string
	 */
	public $addFunc;
	/**
	 * update method function name
	 * @var string
	 * @param function(id, start, end, isallday, title)
	 */
	public $updateFunc;
	/**
	 * update method function name
	 * @var string
	 * @param function(id, start, end, isallday, title)
	 */
	public $calType = 'none';//support event,?...
	public $popupOp;
	
	public $readonly = false;
	
	public $htmlOptions;
	/**
	 * Publishes the required assets
	 */
	public function init() {
		parent::init();
		$this->registerClientScript();
	}
	
	public function registerClientScript() {
	    $view = $this->getView();
	    CalendarAsset::register($view);
	}
	
	/**
	 * Renders the widget.
	 */
	public function run() {
		if (!isset($this->htmlOptions['id'])) {
			$this->htmlOptions['id'] = "calhead";
		}
		
		$this->options['readonly'] = $this->readonly;
		$options = Json::encode($this->options);
		
		$js = "gcalendar_init('{$this->htmlOptions['id']}', {$options} ". (($this->popupId)?", '{$this->popupId}'":'').(($this->addFunc)?", '{$this->addFunc}'":'').(($this->updateFunc)?", '{$this->updateFunc}'":'').(($this->linkFunc)?", '{$this->linkFunc}'":'').(($this->loadFunc)?", '{$this->loadFunc}'":'').");";
		
		$view = $this->getView();
		
		$view->registerJs($js);
		$view->registerJs("typeVal='".$this->calType."'; popupOp='".$this->popupOp."';");
		
		echo $this->render("calview",[
		    'readonly'=>$this->readonly,
		]);
	}

}
