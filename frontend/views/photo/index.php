<?php
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
$this->title = ''.yii::t('common','相册管理').'';

$this->params['breadcrumbs'][]=['label'=>$this->title];
?>

<div class="row">
    <!--    grop-left-->
    <?= $this->render('_group-left') ?>
    
    <div class="col-lg-9">

    <!--  page-body-->
        <div class="page-body"> 
            <p><b>相册上传</b></p>
            <ul>
            <li><a href="<?= Url::to([ 'photo/set-photo']); ?>"><?=yii::t('common','上传')?></a></li>
            </ul>   
        </div>
        <div class="page-body">
            <p><b>相册管理列表：</b><?=Yii::$app->user->identity->username; ?></p>
               <?php foreach ($res['data'] as $key => $value):?>
               <div class="col-lg-4 label-img-size">
                    <a href="#" class="post-label">
                        <img src="<?=$value['picture']?>" alt="<?=$value['created_at']?>">
                    </a>
                </div> 
               <?php endforeach;?>
        </div>
        <div class="page"><?=LinkPager::widget(['pagination' => $res['page']]);?></div>
              <?php if(empty($res['data'])): ?>
        <p>当前未查询到您有相关相册，快去上传试试吧！</p>
              <?php endif;?>
    </div>
</div>