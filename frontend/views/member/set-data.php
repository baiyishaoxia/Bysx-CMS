<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = ''.yii::t('common','Personal center').'';

$this->params['breadcrumbs'][]=['label'=>$this->title];
?>

<div class="row">
    <!--    grop-left-->
    <?= $this->render('_group-left') ?>
    
    <div class="col-lg-9">

    <!--  page-header-->
    <?= $this->render('_page-header') ?>
        
        <div class="page-body">
        <?php  $form = ActiveForm::begin()?>
           <?= Html::activeHiddenInput($model,'user_id') ?>
           <?= $form->field($model, 'real_name')->textInput(['maxlength' => true]) ?>    
           <?= $form->field($model, 'sex')->dropDownList(['0'=>'保密','1'=>'男','2'=>'女']) ?>     
           <?= $form->field($model, 'qq')->textInput(['maxlength' => 11]) ?>       
           <?= $form->field($model, 'tel_phone')->textInput(['maxlength' => 11]) ?>        
           <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>      
           <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>        
           <?= $form->field($model, 'signature')->textInput(['maxlength' => true]) ?>     
        </div>
        
           <div class="form-group">
           <?=Html::submitButton(yii::t('common','Save'),['class'=>'btn btn-success'])?>
           </div>
       <?php ActiveForm::end() ?>
        
    </div>
</div>
