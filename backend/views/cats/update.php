<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CatsModel */

$this->title = ''.yii::t('backend','Update Cats Model:').'' . ' ' . $model->cat_name;
$this->params['breadcrumbs'][] = ['label' => ''.yii::t('backend','Cats Models').'', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cat_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ''.yii::t('backend','Update').'';
?>
<div class="cats-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
