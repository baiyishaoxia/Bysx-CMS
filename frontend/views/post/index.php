<?php 
use frontend\widgets\post\PostWidget;
use yii\base\widget;
use frontend\widgets\hot\HotWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\tag\TagWidget;

$this->title = ''.yii::t('common','My space-title').'';
?>

         <div class="col-lg-9">
              <?=PostWidget::widget();?>

              <?php 
              //可覆盖PostWidget中的组件配置
              //PostWidget::widget(['limit'=>1,'more'=>'true','page'=>'true']); 
              ?>
         </div>
         
         <!--如果不是游客，可以自己创建文章 -->
         <div class="col-lg-3">
              <?php if(!\Yii::$app->user->isGuest):?>
                <?php if($vip_lv['vip_lv'] > 3 ) :?>
                <div class="panel"> 
                     <a class="btn btn-success btn-block btn-post" href="<?=Url::to(['post/create'])?>"><?=yii::t('common','CreateArticle') ?>
                     </a>
                 </div>
              <?php endif;?> 
              <?php endif;?> 
             
             <!--热门浏览 -->
             <?=HotWidget::widget()?>

             <!--标签云 -->
             <?=TagWidget::widget()?>   
         
         </div>
</div>