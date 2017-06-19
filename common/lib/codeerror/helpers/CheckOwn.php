<?php

namespace common\lib\codeerror\helpers;
use backend\modules\ezforms\models\Ezform;

use Yii;

class CheckOwn
{
    public static function checkOwnForm($form_id)
    {
        $num_form = Ezform::find()
            ->innerJoin('ezform_favorite', '`ezform`.`ezf_id` = `ezform_favorite`.`ezf_id`')
	    ->andWhere('ezform.`status` <> :status', [':status' => 3])
	    ->andWhere(['ezform_favorite.userid' => Yii::$app->user->id])
            ->andWhere(['`ezform`.`ezf_id`' => $form_id])    
            ->count();
        //return 1;
        return $num_form;
    }
}

