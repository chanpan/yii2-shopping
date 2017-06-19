<?php

namespace common\lib\codeerror\helpers;
use backend\modules\ezforms\models\Ezform;

use Yii;

class GenTree
{
    public static function generateChildArray($arr, $parent = 0)
    {
        $childs = [];
        foreach ($arr as $child) {
            if ($child['parent'] == $parent) {
                $child['sub'] = isset($child['sub']) ? $child['sub'] : self::generateChildArray($arr, $child['id']);
                $childs[] = $child;
            }
        }
        return $childs;

    }

    public static function generateChildHTML($childs, $tabs = "")
    {

        $tab = '    ';
        $html = '<ul>';
        foreach ($childs as $child) {

            $html .= $tabs.$tab.'<li>';

            $html .= '<span class="js-tree" data-id="'.$child['id'].'"><i class="icon-minus-sign"></i>'.$child['name'].'</span>';

            if(isset($child['sub'][0])) {
                $html .= self::generateChildHTML($child['sub'], $tabs.$tab);
            }
            $html .= '</li>';
        }
        $html .= $tabs.'</ul>';

        return $html;
    }
}
