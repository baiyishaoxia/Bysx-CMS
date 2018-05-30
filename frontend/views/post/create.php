<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title =''.yii::t('common','Create').'';
$this->params['breadcrumbs'][]=['label'=>''.yii::t('common','article').'','url'=>['post/index']];
$this->params['breadcrumbs'][]=$this->title;

?>
<div class="row">
       <div class="col-lg-9">
        <div class="panel-title box-title">
           <span><?=yii::t('common','CreateArticle') ?></span>              
        </div>
         <div class="panel-body">
            <?php  $form = ActiveForm::begin()?>
             <?=$form->field($model,'title')->textinput(['maxlength'=>true]) ?>
             <?=$form->field($model, 'cat_id')->dropDownList($cat) ?>
             <?= $form->field($model, 'label_img')->widget('common\widgets\file_upload\FileUpload',[
            'config'=>[
                //图片上传的一些配置，不写调用默认配置
                'domain_url' => ''.Yii::t('common','frontend_url').'',
                 ]
            ]) ?>
            <?= $form->field($model, 'content')->widget('common\widgets\ueditor\Ueditor',[
                 'options'=>[
                 'initialFrameHeight' => 160,
                 'toolbars'=>[
                                ['fullscreen', 'source', 'undo', 'redo', 'bold']
                                ]
                          ]
                 ]) ?>
           
            <?=$form->field($model,'tags')->widget('common\widgets\tags\TagWidget') ?>
            <div class="form-group">
            <?=Html::submitButton(yii::t('common','release'),['class'=>'btn btn-success'])?>
            </div>
            <?php ActiveForm::end() ?>
         </div>
       </div>
       <div class="col-lg-3">
             <div class="panel-title box-title">
             <span><?=Yii::t('common','Matters needing attention')?></span>
             </div>
             <div class="panel-body">
                <p>1.作者为了考虑到知识广泛性，特开发用户登录后即可发布文章。</p>
                <p>2.开发该功能仅仅为了让每一位用户可以发表自己所学习的知识点及讨论交流问题。</p>
                <p>3.为了维护绿色网站，对用户发布不良信息将作封号处理。</p>
             </div>
       </div>
</div>