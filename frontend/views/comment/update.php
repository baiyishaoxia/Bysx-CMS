<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CommentModel */
$this ->params['breadcrumbs'][]=['label'=>'文章','url'=>['post/index']];
$this->title = '修改评论 ';
$this->params['breadcrumbs'][] = ['label' => $post_title, 'url' => ['post/view','id'=>$model->post_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
  
<div class="row">
    <div class="col-lg-9">    
          <div class="panel-title box-title">
              <span>修改评论</span>
          </div>
          <div class="panel-body">
             <?php  $form = ActiveForm::begin()?>
                <?= $form->field($model, 'content')->label(''.yii::t('common','content').'')->widget('common\widgets\ueditor\Ueditor',[
                                         'options'=>[
                                            'initialFrameHeight' => 100,
                                            'toolbars'=>[
                                                         ['fullscreen', 'source', 'undo', 'redo','insertcode'],
                                                        ]
                                                    ]  
                 ]) ?>
            <div class="form-group">
            <?=Html::submitButton(yii::t('common','Update'),['class'=>'btn btn-success'])?>
            </div>
             <?php ActiveForm::end() ?>
          </div>
  </div>
  <div class="col-lg-3">
                <div class="panel-body">
                <p>公告：</p>   
                <p>以下有关隐藏的功能按钮操作需要联系管理员分配,并获取创建、编辑等其它权限：</p>
                <p>1.作者为了考虑到知识广泛性，特开发用户登录后联系管理可发布文章。</p>
                <p>2.开发该功能仅仅为了让每一位用户可以发表自己所学习的知识点及讨论交流问题。</p>
                <p>3.为了维护绿色网站，对用户发布不良信息将作封号处理。</p>
                <p>4.作者最近在忙毕业论文，其他功能后续开发...</p>
                <p>5.联系方式:QQ【2273465837】;</p>
                <p>微信:TZF2273465837【风过无痕】</p>
             </div>
  </div> 
</div>
