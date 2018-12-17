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
                    <a href="javascript:lookImg('原图','<?=$value['picture']?>')" class="post-label" target="_blank">
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
<script>
    function lookImg(name, url) {
        layer.open({
            type: 1,
            title: false,
            closeBtn: 1,
            shadeClose: true,
            maxmin: true,             //开启最大，最小，还原按钮，只有type为1和2时，才能设置
            area: ['auto', 'auto'], //宽高
            content: "<img alt=" + name + " title=" + name + " src=" + url + " />"
        });
    }
</script>