<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = ''.yii::t('common','账号设置').'';

$this->params['breadcrumbs'][]=['label'=>$this->title];
?>

<div class="row">
    <!--    grop-left-->
    <?= $this->render('_group-left') ?>
    
    <div class="col-lg-9">

    <!--  page-header-->
    <?= $this->render('_page-header') ?>
    
        <div class="page-body">
        <p>修改邮箱需重新激活新邮箱，请正确填写邮箱！</p>
        <?php  $form = ActiveForm::begin()?>
  
           <?= $form->field($model, 'email')->textInput() ?>       
        
           <div class="form-group">
           <?=Html::submitButton(yii::t('common','修改'),['class'=>'btn btn-success'])?>
           </div>
        <?php ActiveForm::end() ?>
        </div>
    </div>
</div>