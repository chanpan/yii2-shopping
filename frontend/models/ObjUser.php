<?php
 
namespace frontend\models;
 
class ObjUser {
    public static function getUser(){
        $user = User::find()->all();
        return $user;
    }
}
