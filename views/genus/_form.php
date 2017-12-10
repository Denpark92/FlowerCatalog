<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Genus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="genus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?php if (!$model->isNewRecord) {
            echo Html::a('Отменить', ['genus/view', 'id' => $model->id], ['class' => 'btn btn-primary']);
        } ?>
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
