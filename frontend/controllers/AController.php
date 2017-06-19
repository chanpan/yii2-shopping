<?php
 
namespace frontend\controllers;
use yii\web\Controller; 
use Yii;
class AController extends Controller{
    public function actionIndex(){
       $a = 10;
       $b = 20;
       $sum = $a+$b;
       
      $query = \frontend\models\ObjUser::getUser();
      return \yii\helpers\Json::encode($query); 
//       return $this->render("index",[
//           'a'=>$a,
//           'b'=>$b,
//           'sum'=>$sum,
//           'query'=>$query
//       ]);
    }
    public function actionTest(){
        return $this->render("index");
    }
    public function actionUpdate(){
        $name = \Yii::$app->request->post('name');
        
        $sql="insert into user(username) values(:name)";
        $query = \Yii::$app->db->createCommand($sql,[
            ':name'=> $name
        ])->execute();
        
        $model->username = $name;
        $model->save();
        echo $name;
    }
}
