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
                'confirm' => 'Вы точно хотите удалить цветок?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'genus_id',
                'value' => $model->genus->name,
            ],
            'description:ntext',
        ],
    ]) ?>

    <div class="row">
    <?php
    if ($images) {
        foreach ($images as $image) {
    ?>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a href="<?= '/upload/catalog/' . $image ?>" rel="gallery">
                <?= Html::img('@web/upload/catalog/' . $image, ['style' => 'max-width: 100%']); ?>
                </a>
            </div>
    <?php
        }
    }
    ?>
    </div>

</div>
