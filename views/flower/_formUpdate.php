<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\Genus;
use app\models\FlowerImage;

/* @var $this yii\web\View */
/* @var $model app\models\Flower */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="flower-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?php $items = ArrayHelper::map(Genus::find()->all(),'id','name'); ?>
    <?= $form->field($model, 'genus_id')->dropDownList($items); ?>

    <?php
    if ($images) {
        foreach ($images as $image) {
            echo Html::img('@web/upload/catalog/' . $image, ['style' => 'width: 200px;']);
        }
    }
    ?>

    <?php $flowerImage = new FlowerImage(); ?>
    <?= $form->field($flowerImage, 'path[]')->fileInput(['multiple' => true]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Редактировать', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
