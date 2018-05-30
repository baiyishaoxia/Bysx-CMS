<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\VipModel;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-model-form">

    <?php $form = ActiveForm::begin(); ?>
     
    <?= $form->field($model, 'vip_lv')->dropDownList(VipModel::find()
						->select(['name','id'])
						->orderBy('lv')
						->indexBy('id')
						->column(),
    		                                ['prompt'=>'请选择会员等级']);?>
    <?= $form->field($model, 'status')->dropDownList(['0'=>'非激活','10'=>'激活']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? ''.yii::t('backend','Create').'' : ''.yii::t('backend','Update').'', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
