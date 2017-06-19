<?php

namespace common\lib\sdii\widgets;

use Yii;
use yii\helpers\Html;
use yii\bootstrap\Widget as BaseWidget;
use yii\helpers\ArrayHelper;

/**
 * MapInput class file UTF-8
 * @author SDII <iencoded@gmail.com>
 * @link http://www.appxq.com/
 * @copyright Copyright &copy; 2015 AppXQ
 * @license http://www.appxq.com/license/
 * @package appxq\sdii\widgets
 * @version 2.0.0 Date: Sep 5, 2015 3:18:34 PM
 * @example 
 */
class CreateTableView extends BaseWidget {

    public $content = '';
    public function init() {
	parent::init();
	
    }

    /**
     * Renders the widget.
     */
    public function run() {
	$id = $this->options['id'];
	$strArr = explode('(', $this->content);
	$getTableName = str_replace('CREATE TABLE ', '', $strArr[0]);
	$getTableName = trim(str_replace('`', '', $getTableName));
	
	$strArr = explode('ENGINE', $this->content);
	$getEngine = 'ENGINE'.trim(str_replace(';', '', $strArr[1]));
	
	preg_match_all("/[,\(][\s]*([^\s]+)[\s]+([\w]+)([\s](\(([^\)]+)\))|(\(([^\)]+)\)))?/is", $this->content, $feild);
	
	//\yii\helpers\VarDumper::dump($feild,10,true);
	
	echo Html::beginTag('div', $this->options) . "\n";
	echo "
	    <table class=\"table table-bordered\" style=\"width: auto !important;\"> 
		<thead> 
		    <tr> <th style=\"text-align: center; \" colspan=\"3\">$getTableName</th> </tr> 
		</thead> 
		<tbody> 
		    ";
	$row = count($feild[0]);
	for($i=0;$i<$row;$i++){
	    if($feild[1][$i]==='PRIMARY' || $feild[1][$i]==='primary'){
		continue;
	    }
	    $item = str_replace('`', '', $feild[1][$i]);
	    $pk = $this->getPk($item, $feild[5]);
	    echo "<tr> 
		    <td style=\"width: 200px;\">$item</td> 
		    <td style=\"width: 200px;\">{$feild[2][$i]}{$feild[6][$i]}</td> 
		    <td style=\"width: 60px; text-align: center;\" >$pk</td>
		</tr>";
	}
	$content = nl2br($this->content);
	echo "
		</tbody> 
		<tfoot>
		    <tr><td colspan=\"3\">$getEngine <button id=\"$id-bnt-open\" type=\"button\" class=\"btn btn-default\"><i class=\"glyphicon glyphicon-eye-open\"></i></button></td></tr>
		    <tr id=\"$id-sql\" data-show=\"hide\" style=\"display: none;\"><td colspan=\"3\">$content</td></tr>	
		</tfoot>
	    </table>
	";
	echo "\n" . Html::endTag('div');
	
	$view = $this->getView();
	$view->registerJs("
	    $('#$id-bnt-open').click(function(){
		if($('#$id-sql').attr('data-show')=='show'){
		    $('#$id-sql').attr('data-show','hide');
		    $('#$id-sql').hide();
		} else {
		    $('#$id-sql').attr('data-show','show');
		    $('#$id-sql').show();
		}
	    }); 
	", \yii\web\View::POS_READY);
    }

    private function getPk($item, $data){
	foreach ($data as $key => $value) {
	    if($value!=''){
		$pkArr = explode(',', $value);
		foreach ($pkArr as $i => $v) {
		    if($this->getItem($v)==$item){
			
			return '<i class="fa fa-key"></i>';
		    }
		}
	    }
	}
	return '';
    }
    
    private function getItem($value){
	return trim(str_replace('`', '', $value));
    }
}
