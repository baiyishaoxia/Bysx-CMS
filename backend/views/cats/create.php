<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CatsModel */

$this->title = ''.yii::t('backend','Create Cats Model').'';
$this->params['breadcrumbs'][] = ['label' => ''.yii::t('backend','Cats Models').'', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cats-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
