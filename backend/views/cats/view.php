<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CatsModel */

$this->title = ''.yii::t('backend','The current category').''.$model->cat_name;
$this->params['breadcrumbs'][] = ['label' => ''.yii::t('backend','Cats Models').'', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cats-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(''.yii::t('backend','Update').'', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(''.yii::t('backend','Delete').'', ['delete', 'id' => $model->id], [
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
            'id',
            'cat_name',
        ],
    ]) ?>

</div>
