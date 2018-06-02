<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FlowerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flower-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-horizontal col-lg-1 pull-right',
        ],
    ]); ?>

    <?php
    foreach ($flowerAlphabet as $letter)
        $radioListValues[$letter['name']] = $letter['name'];
    $radioListValues[''] = 'Все';
    ?>

    <?= $form->field($model, 'name')->dropDownList($radioListValues, ['onchange' => 'this.form.submit()'])->label(false); ?>

    <?php ActiveForm::end(); ?>

</div>
