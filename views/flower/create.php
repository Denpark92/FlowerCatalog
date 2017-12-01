<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Flower */

$this->title = 'Создание цветка';
$this->params['breadcrumbs'][] = ['label' => 'Цветы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flower-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
