<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CatsModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cats-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? ''.yii::t('backend','Create').'' : ''.yii::t('backend','Update').'', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
