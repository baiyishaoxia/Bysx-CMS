<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = ''.yii::t('common','Head set').'';

$this->params['breadcrumbs'][]=['label'=>$this->title];
?>

<div class="row">
    <!--    grop-left-->
    <?= $this->render('_group-left') ?>
    
    <div class="col-lg-9">

    <!--  page-header-->
    <?= $this->render('_page-header') ?>

        <div class="page-body"> 
            <p><b><?=yii::t('common','Custom heads')?></b></p>
            <ul>
            <li><a href="<?= Url::to([ 'member/update']); ?>"><?=yii::t('common','上传')?></a></li>
            </ul>   
        </div>
        <div class="page-body avatar-list">
            <p><b><?=yii::t('common','Replace the picture') ?></b></p>
            <ul class="j_Alteravatar" data-url="<?= Url::to([ 'member/save-avatar']); ?>">
                <li><img src="/statics/images/avatar/avatar_1.jpg" avatar-url="/image/avatar/avatar_1.jpg"><div class="mask">设为头像</div></li>
                <li><img src="/statics/images/avatar/avatar_2.jpg" avatar-url="/image/avatar/avatar_2.jpg"><div class="mask">设为头像</div></li>
                <li><img src="/statics/images/avatar/avatar_3.jpg" avatar-url="/image/avatar/avatar_3.jpg"><div class="mask">设为头像</div></li>
                <li><img src="/statics/images/avatar/avatar_4.jpg" avatar-url="/image/avatar/avatar_4.jpg"><div class="mask">设为头像</div></li>
                <li><img src="/statics/images/avatar/avatar_5.jpg" avatar-url="/image/avatar/avatar_5.jpg"><div class="mask">设为头像</div></li>
                <li><img src="/statics/images/avatar/avatar_6.jpg" avatar-url="/image/avatar/avatar_6.jpg"><div class="mask">设为头像</div></li>
                <li><img src="/statics/images/avatar/avatar_7.jpg" avatar-url="/image/avatar/avatar_7.jpg"><div class="mask">设为头像</div></li>
                <li><img src="/statics/images/avatar/avatar_8.jpg" avatar-url="/image/avatar/avatar_8.jpg"><div class="mask">设为头像</div></li>
                <li><img src="/statics/images/avatar/avatar_9.jpg" avatar-url="/image/avatar/avatar_9.jpg"><div class="mask">设为头像</div></li>
                <li><img src="/statics/images/avatar/avatar_10.jpg" avatar-url="/image/avatar/avatar_10.jpg"><div class="mask">设为头像</div></li>
                <li><img src="/statics/images/avatar/avatar_11.jpg" avatar-url="/image/avatar/avatar_11.jpg"><div class="mask">设为头像</div></li>
                <li><img src="/statics/images/avatar/avatar_12.jpg" avatar-url="/image/avatar/avatar_12.jpg"><div class="mask">设为头像</div></li>
            </ul> 
        </div>

    </div>

</div>
