<?php 

use frontend\widgets\post\PostHotWidget;
use frontend\widgets\tag\TagWidget;

$this->title = ''.yii::t('common','My space-title').'';
?>
<div class="row">
   <div class="col-lg-9">
        <!--热门文章 -->
        <?=PostHotWidget::widget();?>
   </div>

  
   <div class="col-lg-3">
         <!--标签云 -->
        <?=TagWidget::widget()?>    
   </div>

</div>
