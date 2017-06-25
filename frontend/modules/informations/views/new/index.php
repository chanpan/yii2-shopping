<?php 
    use yii\helpers\Url;
    use yii\helpers\Html;
    $img = \Yii::getAlias('@storageUrl') . "/web/img/";
    $image = \Yii::getAlias('@storageUrl') . "/web/image/";
    use common\lib\sdii\widgets\SDModalForm;
    $this->title = "ข่าวสาร ";
    //$this->params['breadcrumbs'][] = ['label' => 'รายการสินค้า', 'url' => ['/products/prod']];
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="container" id="container">
    <h2><?= Html::encode($this->title);?></h2>
</div>
