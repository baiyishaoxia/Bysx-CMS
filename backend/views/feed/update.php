<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\FeedModel */

$this->title = 'Update Feed Model: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Feed Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feed-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
