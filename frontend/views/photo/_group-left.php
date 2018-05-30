<?php
use yii\helpers\Url;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title"><?=yii::t('common','The user center') ?></h2>
                </div>
                <div id="list-group-left" class="list-group">
                    <?php $AC =  $this->context->id.'/'.$this->context->action->id; ?>
                    <?php $set=$notice=$collect=$sign =$photo= '';
                          if($AC == "member/set-data" || $AC == "member/set-avatar" || $AC == "member/set-password" || $AC == "member/set-email" ){$set = "active"; }
                          else if($AC == "member/set") {$set = "active";}
                          if($AC == "photo/index"){$photo = "active";}
                    ?>
                    <ul>
                    <li class="<?=$set?>"><a href="<?= Url::to([ 'member/set']); ?>"><i class="fa fa-gear"></i><?=yii::t('common','Account Settings')?></a></li>
                    <li class="<?=$notice?>"><a href="<?= Url::to([ 'member/notice']); ?>"><i class="fa fa-bell"></i><?=yii::t('common','I remind of')?></a></li>
                    <li class="<?=$collect?>"><a href="<?= Url::to([ 'member/collect']); ?>"><i class="fa fa-star"></i><?=yii::t('common','My collection')?></a></li>
                    <li class="<?=$sign?>"><a href="<?= Url::to([ 'member/sign']); ?>"><i class="fa fa-envelope"></i><?=yii::t('common','I sign in')?></a></li>
                    <li class="<?=$photo?>"><a href="<?= Url::to([ 'photo/index']); ?>"><i class="fa fa-envelope"></i><?=yii::t('common','Photo album management')?></a></li>
                    </ul>    
                </div>        
            </div>
        </div>
