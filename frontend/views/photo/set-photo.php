<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;



/* @var $this yii\web\View */
/* @var $model common\models\UserModel */

$this->title = '上传相册：'.$user['username'];
$this->params['breadcrumbs'][] = ['label' => '个人中心', 'url' => ['member/set-data','id'=> Yii::$app->user->id ]];
$this->params['breadcrumbs'][] = ['label' => '相册管理', 'url' => ['photo/index','id'=> Yii::$app->user->id ]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-model-update">
    <h3><?= Html::encode($this->title) ?></h3>
      <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model, 'picture')->widget('common\widgets\file_upload\FileUpload') ?>
    <div class="form-group">
      <?=Html::submitButton(yii::t('common','上传'),['class'=>'btn btn-success'])?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
