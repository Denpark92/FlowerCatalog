<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Genus */

$this->title = 'Создание семейства';
$this->params['breadcrumbs'][] = ['label' => 'Семейство', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="genus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
