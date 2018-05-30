<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = ''.yii::t('common','修改密码').'';

$this->params['breadcrumbs'][]=['label'=>$this->title];
?>

<div class="row">
    <!--    grop-left-->
    <?= $this->render('_group-left') ?>
    
    <div class="col-lg-9">

    <!--  page-header-->
    <?= $this->render('_page-header') ?>

        <?php  $form = ActiveForm::begin()?>
  
           <?= $form->field($model, 'oldPassword')->passwordInput(['minlength' => 6]) ?>       
           <?= $form->field($model, 'newPassword')->passwordInput(['minlength' => 6]) ?>        
           <?= $form->field($model, 'rePassword')->passwordInput(['minlength' => 6]) ?>      
           <span style="color:red"><?=$msg?></span>
        
           <div class="form-group">
           <?=Html::submitButton(yii::t('common','修改'),['class'=>'btn btn-success'])?>
           </div>
        <?php ActiveForm::end() ?>
        
    </div>
</div>
