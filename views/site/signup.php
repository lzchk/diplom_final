<?php

/** @var app\models\SignupForm $model */
/** @var yii\bootstrap5\ActiveForm $form */
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use app\models\Specialty;



?>
<?php $form = ActiveForm::begin() ?>
<?= $form->field($model,'username')?>
<?= $form->field($model,'password')?>
<?= $form->field($model, 'group_id')->dropDownList(ArrayHelper::map(\app\models\GroupNumber::find()->all(), 'id','name')) ?>



<div class="form-group">
    <div >
        <?= Html::submitButton('Регистраия', ['class' => 'btn btn-success']) ?>
    </div>
</div>


<?php ActiveForm::end() ?>
