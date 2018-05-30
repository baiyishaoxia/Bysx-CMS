<?php
use yii\helpers\Url;
use frontend\widgets\tag\TagWidget;

/* @var $this yii\web\View */
$this->title = ''.yii::t('common','Search-title').'';

$this->params['breadcrumbs'][]=['label'=>''.yii::t('common','Search').''];
?>
<div class="row">
    <div class="col-lg-12">
          <div class="question-top clearfix ">
            <h1 class="question-top-tips pull-left"><?=yii::t('common','Still not able to solve your problem? Ask questions!') ?></h1>
            <a class="btn btn-success pull-right" href="#"><?=yii::t('common','I want to ask questions') ?></a>
          </div>
    </div>

    <div class="col-lg-9">
        <div class="panel-title box-title">
                   <span><?=yii::t('common','The search results') ?></span>
       </div>

        <ul id="w1" class="panel-body padding-left-0 media-list">
                <?php if(empty($data)):?>
                     <li class="media" data-key="0">
                        <?=yii::t('common','Search results do not exist, change keywords to try or ask questions.')?>
                     </li>
                <?php else:?>
                    <?php foreach ($data as $list):?>
                            <!--提取信息-->
                    <?php
                    $id = $list['user_id'];
                    $file_path = "image/userAvatar/$id.txt";
                    if(file_exists($file_path)){
                        $str = file_get_contents($file_path);
                        if($str == null || $str == "" || $str == ''){
                           $str = \Yii::$app->params['avatar']['small'];
                          }
                    }else $str = \Yii::$app->params['avatar']['small'];
                    ?>
                      <li class="media" data-key="0">
                           <div class="media-left">
                               <a href="<?= Url::to([ 'member/index-site','id'=> $id]) ?>" rel="author" data-original-title="" title="">
                                   <img src="<?=$str?>" alt="<?=($list['user_name']?$list['user_name']:Yii::$app->user->identity->username)?>" style="width: 48px;height: 48px">
                               </a>
                           </div>
                           <div class="media-body">
                               <h2 class="media-heading"><?=$list['cat']['cat_name']?>
                                   <a href="<?=Url::to(['post/view','id'=>$list['id']])?>" target="_blank"><?=$list['title']?></a>
                               </h2>
                               <div class="media-action">
                                    <?php date_default_timezone_set('PRC');?>
                                   <a href="/member/index/11.html" rel="author" data-original-title="" title=""><?=$list['user']['username']?></a> 发布于 <?= date('Y-m-d H:i:s',$list['created_at'])?>            
                               </div>
                           </div>
                           <div class="media-right media-browse"><a href="#">浏览<em><?=$list['extend']['browser']?></em></a></div>
                           <div class="media-right media-answer"><a href="#">评论<em><?=$list['extend']['comment']?></em></a></div>
                       </li>
                     <?php endforeach;?>
                 <?php endif;?>
       </ul>
    </div>
    
    <div class="col-lg-3">   
       <!--标签云 -->
        <?=TagWidget::widget()?>  
    </div>
</div>
