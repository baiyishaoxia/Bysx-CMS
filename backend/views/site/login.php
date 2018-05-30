<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = yii::t('backend','Welcome to the background management system.');
$this->params['breadcrumbs'][] = $this->title;
?>
<!--
<div class="sign-overlay"></div>
<div class="signpanel"></div>
-->
<div class="panel signin">
    <div class="panel-heading">
        <h4 class="panel-title"><?=yii::t('backend','Welcome to the background management system.');?></h4>
    </div>
    <div class="panel-body">
      <button class="btn btn-primary btn-quirk btn-fb btn-block">联系我们</button>
      <div class="or">or</div>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?= $form->field($model, 'username',
                        ['inputOptions' =>[
                            'placeholder'=>'请输入账户',],
                             //制定特定的布局
                            'inputTemplate' =>'
                                          <div class="input-group">
                                              <span class="input-group-addon">
                                                     <i class="fa fa-user"></i>
                                              </span>{input}
                                          </div>',  
                          ])->label(false)  ?>

                    <?= $form->field($model, 'password',
                        ['inputOptions' =>[
                            'placeholder'=>'请输入密码',],
                            'inputTemplate' =>'
                                          <div class="input-group">
                                               <span class="input-group-addon">
                                                   <i class="fa fa-lock"></i>
                                               </span>{input}
                                         </div>',  
                          ])->passwordInput()->label(false) ?>
                    <?= $form->field($model, 'captcha')->widget(Captcha::className()) ?>

        <div><a href="#" class="forgot">忘记密码?</a></div>

        <div class="form-group">
            <?= Html::submitButton('登录', ['class' => 'btn btn-primary btn-quirk btn-block btn-success ', 'name' => 'login-button']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    </div>

      









   
