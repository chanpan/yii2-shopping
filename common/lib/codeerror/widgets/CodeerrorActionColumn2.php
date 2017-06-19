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
class CodeerrorActionColumn2 extends ActionColumn {
    public $pjax_id;
    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        if (!isset($this->buttons['undo'])) {
            $this->buttons['undo'] = function ($url, $model, $key) {
                return Html::a('<span class="fa fa-undo"></span> Undo', $url, [
                    'data-action' => 'undo',
                    'title' => Yii::t('yii', 'Undo'),
                    'class'=>'btn btn-warning btn-xs',
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to undo this item?'),
                    'data-method' => 'post',
                    'data-pjax' => isset($this->pjax_id)?$this->pjax_id:'0',
                ]);
            };
        }

        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                return Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', $url, [
            'data-action' => 'delete',
                    'title' => Yii::t('yii', 'Delete'),
                    'class'=>'btn btn-danger btn-xs',
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => isset($this->pjax_id)?$this->pjax_id:'0',
                ]);
            };
        }
    }

}

