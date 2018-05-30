<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CatsModel;
/* @var $this yii\web\View */
/* @var $model common\models\PostModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'summary')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
                                                'options'=>[
                                                   'initialFrameHeight' => 350,
                                                  ]
                                               ]) ?>

    <?php // $form->field($model, 'label_img')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload',[
            'config'=>[
                //图片上传的一些配置，不写调用默认配置
                'domain_url' => ''.Yii::t('common','frontend_url').'',
                 ]
            ]) ?>

    <?php //$form->field($model, 'cat_id')->textInput() ?>
    <?= $form->field($model,'cat_id')->dropDownList(CatsModel::find()
						->select(['cat_name','id'])
						->indexBy('id')
						->column(),
    		                          ['prompt'=>'请选择分类']);?>

    <?php // $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'user_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_valid')->dropDownList(['1'=>'有效','0'=>'无效']) ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <?php //$form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? ''.yii::t('backend','Create').'' : ''.yii::t('backend','Update').'', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
