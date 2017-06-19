<?php
 
namespace frontend\models;
 
class User extends \yii\db\ActiveRecord{
    
   public static function tableName()
   {
        return 'tbl_user';
   } 
}
