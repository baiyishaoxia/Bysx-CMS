<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TagModel */

$this->params['breadcrumbs'][] = ''.yii::t('backend', 'Content Model').'';
$this->title = ''.yii::t('backend', 'Update Tag Model:').' ' . ' ' . $model->tag_name;
$this->params['breadcrumbs'][] = ['label' => ''.yii::t('backend', 'Tag Models').'', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tag_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ''.yii::t('backend', 'Update').'';
?>
<div class="tag-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
