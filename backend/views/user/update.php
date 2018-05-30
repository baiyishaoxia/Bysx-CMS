<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */

$this->title = '编辑: ' . ' ' .$model->username .'/'.$model->id;
$this->params['breadcrumbs'][] = ['label' => '会员信息', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="user-model-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
