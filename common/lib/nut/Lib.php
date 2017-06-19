<?php
namespace common\lib\nut;
class Lib {
    //put your code here
    public static function ArrayToObject($arr){
        return (object)array_map(function($item) { return is_array($item) ? (object)$item :  $item;  }, $arr);
    }
}
