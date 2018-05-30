<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\avatar\AvatarWidget;


/* @var $this yii\web\View */
/* @var $model common\models\UserModel */

$this->title = '更新头像(用户名: ' . ' ' . $model->username.')';
$this->params['breadcrumbs'][] = ['label' => '个人中心', 'url' => ['member/set-data','id'=> Yii::$app->user->id ]];
$this->params['breadcrumbs'][] = '更改头像';
?>
<div class="user-model-update">
     
    <h3><?= Html::encode($this->title) ?></h3>
       
      <?php $form = ActiveForm::begin(); ?>
      <?php  /*
            $id = \Yii::$app->user->id;
            $file_path = "image/userAvatar/$id.txt";
            if(file_exists($file_path)){
                $str = file_get_contents($file_path);//将整个文件内容读入到一个字符串中
                if($str == null || $str == "" || $str == ''){
                   $str = \Yii::$app->params['avatar']['small'];
                  }
            }else {$str = \Yii::$app->params['avatar']['small'];}
            */
        ?>

      <?php // AvatarWidget::widget(['imageUrl'=>$str]); ?>

     <?= $form->field($model, 'avatar_img')->widget('common\widgets\file_upload\FileUpload',[
                    'config'=>[
                         //图片上传的一些配置，不写调用默认配置
                         'domain_url' => ''.Yii::t('common','frontend_url').'',
                         ]
            ]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
