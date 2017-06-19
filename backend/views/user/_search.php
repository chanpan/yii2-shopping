<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm; 
?>
<?php

$form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => ['data-pjax' => true,'class' => 'form-inline text-right']
        ]);
?>

<?php

echo '<div class="form-group">';
echo '<label for="usersearch-username">ค้นหา: </label> ';
echo Html::activeTextInput($model, 'searchName', ['style' => 'width: 200px;', 'class' => 'form-control', 'placeholder' => 'username, ชื่อ-สกุล']);
echo '</div>';

echo '<div class="form-group" style="margin-right:5px;">';
echo '<label for="usersearch-username"> สถานะ:</label> ';
echo Html::activeDropDownList($model, 'searchStatus', ['' => 'All', 1 => 'Not Active', 2 => 'Active', 3 => 'Deleted'], ['class' => 'form-control']);
echo '</div>';
?>
<?php echo Html::submitButton(Yii::t('backend', '<i class="fa fa-search"></i> ค้นหา'), ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?> 