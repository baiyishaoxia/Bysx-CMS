<?php
use yii\helpers\Url;

?>
        
        <div class="page-header">
            <h1><?=yii::t('common','Head set') ?></h1>
            <ul id="w0" class="nav nav-tabs nav-main">
                <?php $AC =  $this->context->id.'/'.$this->context->action->id; ?>
                <?php $setdata=$setavatar=$setpwd=$setemail = '';
                      if($AC == "member/set-data"){$setdata = "active"; }
                      else if($AC == "member/set-avatar"){$setavatar = "active"; }
                      else if($AC == "member/set-password"){$setpwd = "active"; }
                      else if($AC == "member/set-email"){$setemail = "active"; }
                ?>
                <li class="<?= $setdata?>"><a href="<?= Url::to([ 'member/set-data']); ?>"><?=yii::t('common','Personal center') ?></a></li>
                <li class="<?= $setavatar?>"><a href="<?= Url::to([ 'member/set-avatar']); ?>"><?=yii::t('common','Head to choose')?></a></li>
                <li class="<?= $setpwd?>"><a href="<?= Url::to([ 'member/set-password']); ?>"><?=yii::t('common','Change the password')?></a></li>
                <li class="<?= $setemail?>"><a href="<?= Url::to([ 'member/set-email']); ?>"><?=yii::t('common','Email address')?></a></li>
            </ul>        
        </div>

