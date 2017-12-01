<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FlowerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Цветы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flower-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => '№',
            ],

            [
                'attribute' => 'genus_id',
                'filter' => false,
                'enableSorting' => false,
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->flowerImages) {
                        foreach ($model->flowerImages as $flowerImage) {
                            if ($flowerImage['main_image'] == 1) {
                                return Html::img('@web/upload/catalog/'.$flowerImage['path'], ['style' => 'width: 200px']);
                            }
                        }
                    }
                    return 'Нет фото';
                },
            ],
            'name',
            [
                'attribute' => 'description',
                'filter' => false,
                'enableSorting' => false,
                'value' => 'description',
            ],
            [
                'attribute' => 'genus_id',
                'value' => 'genus.name',
                'filter' => $genusList,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>
