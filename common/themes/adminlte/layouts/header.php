<?php
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\Url;
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="user-profile">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">Alexander Pierce</span>
                    </a>
                     
                </li>
            </ul>
        </div>
    </nav>
</header>

<?php
    Modal::begin([
        'header' => '<b>User Profile</b>',
        'id' => 'modal-profile',
        'size' => 'modal-xs',
    ]);
    echo "<div id='modalContent'></div>";
    Modal::end();
?>

<?php $this->registerJs("
    $('#user-profile').click(function(){
    //col-xs-12 col-sm-6 col-md-6 text-center รูป
    //col-xs-12 col-sm-6 col-md-6   ข้อความ
        $.ajax({
            url:'".Url::to(['/site/user-info','user_id'=>1])."',
            success:function(data){
                $('#modal-profile').modal('show');
                $('#modalContent').html(data);
            }
        });
    });
     
");?>