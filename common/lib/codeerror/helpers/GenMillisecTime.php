<?php

namespace common\lib\codeerror\helpers;
use backend\modules\ezforms\models\Ezform;

use Yii;

class GenMillisecTime
{
    public static function getMillisecTime()
    {
        list($t1,$t2) = explode(' ', microtime());
        $mst = str_replace('.', '', $t2.$t1);

        return $mst;
    }
}
