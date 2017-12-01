<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Flower */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Цветы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flower-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'description:ntext',
            [
                'attribute' => 'genus_id',
                'value' => $model->genus->name,
            ],
        ],
    ]) ?>

    <?php
    if ($images) {
        foreach ($images as $image) {
            echo Html::img('@web/upload/catalog/' . $image, ['style' => 'width: 200px;']);
        }
    }
    ?>

</div>
