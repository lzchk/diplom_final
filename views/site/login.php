<?php

/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\LoginForm $model */


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;



?>
<div class="site-login">


    <p>У вас еще нет аккаунта?</p>     <input class="btn btn-primary" id="click-to-hide-2" type="button" value="Зарегистрироваться">

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
       // 'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>
    <div class="wpcraft-box-2 hide-element"><?= $form->field($model, 'name')->textInput() ?>
        <?= $form->field($model, 'group_id')->dropDownList(ArrayHelper::map(\app\models\GroupNumber::find()->all(), 'id','name')) ?></div>





        <div class="form-group">
            <div class="col-lg-11">
                <?= $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\" custom-control custom-checkbox\">{input} Запомнить меня</div>\n<div class=\"col-lg-8\">{error}</div>",
                ]) ?>
                <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
<style>
    .hide-element {display: none ;}
</style>
<script>
    /* Вешаем обработчик клика на кнопку */
    var clickToHide2 = document.querySelector('#click-to-hide-2');
    clickToHide2.addEventListener("click", hideVisibleElem);

    /* Функция добавления / удаления класса, который скрывает элемент */
    function hideVisibleElem() {
        let wpcraftBox2 = document.querySelector('.wpcraft-box-2');
        wpcraftBox2.classList.toggle("hide-element");

        /* В зависимости от наличия скрывающего класса меняем текст в кнопке */
        if (wpcraftBox2.classList.contains("hide-element")){
            clickToHide2.value = 'Зарегистрироваться';
        } else {
            clickToHide2.value = 'Авторизироваться';
        }
    }
</script>