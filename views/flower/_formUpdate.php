<?php

use yii\helpers\Html;
use yii\helpers\Url;
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

    <div class="row">
    <?php
    if ($images) {
        foreach ($images as $image) {
    ?>
        <div class="image_item col-lg-3 col-md-3 col-sm-6 col-xs-12 <?= $image->main_image ? main_image : '' ?>">
            <?= Html::img('@web/upload/catalog/' . $image->path, ['style' => 'max-width: 100%;']); ?>
            <?= Html::a('Удалить', ['flower/delete-image', 'id' => $image->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'method' => 'post',
                ],
            ]); ?>
            <?php if (!$image->main_image) { ?>
            <?= Html::a('Сделать главной', ['flower/main-image', 'id' => $image->id, 'main' => true], [
                'class' => 'btn btn-success',
                'data' => [
                    'method' => 'post',
                ],
            ]); ?>
            <?php } else {  ?>
                <?= Html::a('Сделать обычной', ['flower/main-image', 'id' => $image->id, 'main' => false], [
                    'class' => 'btn btn-primary',
                    'data' => [
                        'method' => 'post',
                    ],
                ]); ?>
            <?php }?>
        </div>
    <?php
        }
    }
    ?>
    </div>

    <?php $flowerImage = new FlowerImage(); ?>
    <?= $form->field($flowerImage, 'path[]')->fileInput(['multiple' => true]); ?>

    <?= Html::a('Отменить', ['flower/view', 'id' => $model->id], ['class' => 'btn btn-primary']); ?>
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end(); ?>
    </div>
</div>
