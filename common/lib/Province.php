<?php
namespace common\lib;
class Province {
    public static function getAmphur($province_id){
        $sql="SELECT * FROM `amphur` WHERE `PROVINCE_ID` = :province_id ORDER BY AMPHUR_ID ASC";
        $query = \Yii::$app->db->createCommand($sql,[
            ':province_id'=>$province_id
        ])->queryAll();
        if(!empty($query)){
            $selected = '';
            $out = [];
            foreach ($query as $value) {
               $out[] = ['id' => $value['AMPHUR_ID'], 'name' => $value['AMPHUR_NAME']];
            }
            echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
            return;
        }
        echo \yii\helpers\Json::encode(['output' => '', 'selected' => '']);
    }
    public static function getDistric($amphur_id){
        $sql="SELECT * FROM `district` WHERE AMPHUR_ID = :amphur_id ORDER BY `DISTRICT_NAME` ASC";
        
        $query = \Yii::$app->db->createCommand($sql,[
            ':amphur_id'=>$amphur_id
        ])->queryAll();
        if(!empty($query)){
            $selected = '';
            $out = [];
            foreach ($query as $value) {
               $out[] = ['id' => $value['DISTRICT_ID'], 'name' => $value['DISTRICT_NAME']];
            }
            echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
            return;
        }
        echo \yii\helpers\Json::encode(['output' => '', 'selected' => '']);
    }
    
    public static function getZipcode($amphur_id, $distric_id){
        $sql="SELECT * FROM `zipcode` WHERE `AMPHUR_ID`= :amphur_id AND `DISTRICT_ID`= :distric_id";
        
        $query = \Yii::$app->db->createCommand($sql,[
            ':amphur_id'=>$amphur_id,
            ':distric_id'=>$distric_id
        ])->queryAll();
        if(!empty($query)){
            $selected = '';
            $out = [];
            foreach ($query as $value) {
               $out[] = ['id' => $value['ZIPCODE_ID'], 'name' => $value['ZIPCODE']];
            }
            echo \yii\helpers\Json::encode(['output' => $out, 'selected' => $selected]);
            return;
        }
        echo \yii\helpers\Json::encode(['output' => '', 'selected' => '']);
    }
}
