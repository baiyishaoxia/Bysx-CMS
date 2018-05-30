<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FeedModel */

$this->title = 'Create Feed Model';
$this->params['breadcrumbs'][] = ['label' => 'Feed Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feed-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
