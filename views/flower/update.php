<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Flower */

$this->title = 'Редактирование цветка: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Цветы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="flower-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model,
        'images' => $images,
    ]) ?>

</div>
