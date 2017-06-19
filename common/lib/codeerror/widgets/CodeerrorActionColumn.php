<?php

namespace common\lib\codeerror\widgets;

use Yii;
use Closure;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

/**
 * CodeerrorActionColumn class file UTF-8
 * @author Codeerror <8ohkoovd@gmail.com>
 * @link http://www.codeerror.com/
 * @copyright Copyright &copy; 2015 Codeerror
 * @license http://www.codeerror.com/license/
 * @package
 * @version 2.0.0 Date: Sep 5, 2015 9:52:45 AM
 * @example
 */
class CodeerrorActionColumn extends ActionColumn {
    public $pjax_id;
    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', $url, [
            'data-action' => 'view',
                    'title' => Yii::t('yii', 'View'),
                    'class'=>'btn btn-info btn-xs',
                    'data-pjax' => isset($this->pjax_id)?$this->pjax_id:'0',
                ]);
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                return Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', $url, [
            'data-action' => 'update',
                    'title' => Yii::t('yii', 'Update'),
                    'class'=>'btn btn-warning btn-xs',
                    'data-pjax' => isset($this->pjax_id)?$this->pjax_id:'0',
                ]);
            };
        }
    }

}

