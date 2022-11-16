<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\TypeWork $model */

$this->title = 'Create Type Work';
$this->params['breadcrumbs'][] = ['label' => 'Type Works', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-work-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
