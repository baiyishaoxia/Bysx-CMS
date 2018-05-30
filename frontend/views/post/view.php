<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = $data['title'];
$this ->params['breadcrumbs'][]=['label'=>'文章','url'=>['post/index']];
$this ->params['breadcrumbs'][]=$this->title;

?>
<div class="row">
    <div class="col-lg-9">

        <!-- 标题 -->
        <div class="page-title page-title J_postId" data-id="<?=$data['id']?>">
            <h1><?=$data['title']?></h1>
            <span>作者:<?=$data['user_name']?></span>
            <span><?=Yii::t('common','release')?>:<?=date('Y-m-d',$data['created_at']);?></span>
            <span>浏览:<?=isset($data['extend']['browser'])?$data['extend']['browser']:0?></span>
        </div>

       <!-- 内容 -->
        <div class="page-content">
             <?=$data['content']?>
        </div>
        
       <!-- 标签 -->
        <div class="page-tag">
           <?=Yii::t('common','tags')?>:
           <?php foreach ($data['tags'] as $tag):?>
                      <span><a href="#"><?=$tag ?></a></span>
           <?php endforeach; ?>
        </div>
       
       <!-- 评论展示-->
       <div class="page-header">
         <h2>共 <?=count($comment)?> 条评论</h2>
       </div>   
      <ul id="reply" class="media-list J_mediaList">
      <?php foreach ($comment as $key =>$value) :?>

      <li class="media" data-key="<?=$value['id']?>">
            <div class="media-left">
                <a href="<?= Url::to(['member/index-site','id'=>$value['userid']])?>" rel="author" data-original-title="" title=""><img class="media-object" src="<?=$value['user']['avatar_img']?:\Yii::$app->params['avatar']['small'];?>" alt="<?=$value['user']['username']?>"></a>
            </div>
            <div class="media-body">
                <div class="media-heading">
                    <a href="<?= Url::to(['member/index-site','id'=>$value['userid']])?>" rel="author" data-original-title="" title=""><?=$value['user']['username']?></a> 评论于<?=date('Y-m-d H:i:s',$value['create_time']) ?>
                     <?php if(Yii::$app->user->id === $value['userid']): ?>
                     <span class="pull-right"><a href="<?= Url::to(['comment/update','id'=>$value['id']])?>">修改</a></span>              
                     <?php endif;?>
                </div>
                <div class="media-content"><p><?=$value['content'] ?></p></div>
                <div class="J-media">
                    <?php 
                        foreach ($value['extends'] as $key =>$v){   
                        if($value['id'] == $value['extends'][$key]['parent_id']){
                     ?>
		  <div class="media">
			<div class="media-left"><a href="<?= Url::to(['member/index-site','id'=>$v['exuser']['id']])?>" rel="author" title=""><img class="media-object" src="<?=$v['exuser']['avatar_img']?:\Yii::$app->params['avatar']['small'];?>" alt="<?=$v['exuser']['username']?>" data-bd-imgshare-binded="1"></a></div>
			<div class="media-body">
                            <div class="media-heading">
                            <a href="<?= Url::to(['member/index-site','id'=>$v['exuser']['id']])?>" rel="author" data-original-title="" title="" class="j_name"><?=$v['exuser']['username']?></a> 回复于 <?=date('Y-m-d H:i:s',$v['create_time']) ?>
                            <?php if(Yii::$app->user->id != $v['exuser']['id']){ ?>
                            <span class="pull-right"><a class="reply-btn j_replayAt" href="javascript:;">回复</a></span>
                            <?php }else {?>
                            <span class="pull-right"><a href="<?= Url::to(['comment/edit','id'=>$v['id']])?>">修改</a></span>                
                            <?php }?>
                            </div>
                            <?=$v['content']?>
			</div>
		     </div>
                        <?php }}?>
		</div>
                <div class="media-action">                
                    <span class="reply-btn cursor j_replayBtn">回复</span>                     
                   <form id="w3" class="reply-form j_replayForm" action="" method="post" style="display:none;">                            
                        <div class="form-group field-comment-content required">
                            <textarea id="comment-content" class="form-control" name="comment"></textarea>
                            <div class="help-block"></div>
                        </div>                
                        <div class="form-group">
                            <button type="button" class="btn btn-sm btn-primary J_btnPrimary">回复</button>                
                        </div>
                    </form>
                </div>            
           </div>
    </li>
    <?php endforeach;?>
    </ul>

       <input type="hidden" value="<?= Url::to(['comment/reply'])?>" class="j_reply_url">   
       
       <!--评论-->
       <?php if (Yii::$app->user->isGuest) { ?>
        <div class="panel">
            <div class="panel-content">
                <div class="well danger">您需要登录后才可以评论。<a href="<?= Url::to(['site/login'])?>">登录</a> | <a href="<?= Url::to(['site/signup'])?>">立即注册</a></div>
            </div>
        </div>
       <?php }?> 

      <!--审核评论-->
        <?php if($added) {?>
        <br>
        <div class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

          <h4>谢谢您的回复，我们会尽快审核后发布出来！</h4>

          <p><?= nl2br($commentModel->content);?></p>
                <span class="glyphicon glyphicon-time" aria-hidden="true"></span><em><?= date('Y-m-d H:i:s',$commentModel->create_time)."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";?></em>
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span><em><?= Html::encode($postmodel->user->username);?></em>	  
        </div>			
        <?php }?>
        
      <!-- 评论框-->
      <?php if (!Yii::$app->user->isGuest) { ?>
        <div class="page-comment">
            <div class="panel">
            <div class="panel-content">
             <?php  $form = ActiveForm::begin()?>       
                <?= Html::activeHiddenInput($commentModel,'userid') ?>  
                <?= $form->field($commentModel, 'content')->label(''.yii::t('common','content').'')->widget('common\widgets\ueditor\Ueditor',[
                                        'options'=>[
                                            'initialFrameHeight' => 100,
                                            'toolbars'=>[
                                                        ['fullscreen', 'source', 'undo', 'redo','insertcode'],
                                                    ]
                                       ]
                 ]) ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-success green no-radius">评论</button>        
                </div>
             <?php ActiveForm::end() ?>
         </div>
     </div>           
  </div>
   <?php } ?>
      
</div>


    <div class="col-lg-3">

            <?php if(!\Yii::$app->user->isGuest):?>
                <?php if($vip_lv['vip_lv'] > 5 ) :?>
                <div class="panel"> 
                     <a class="btn btn-success btn-block btn-post" href="<?=Url::to(['post/create'])?>"><?=yii::t('common','CreateArticle') ?></a>
                     <a class="btn btn-info btn-block btn-post" href="<?=Url::to(['post/update','id'=>$data['id']])?>"><?=yii::t('common','UpdateArtile') ?></a> 
                 </div>
              <?php endif;?> 
            <?php endif;?> 
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