<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="panel">
<!-- 只言片语 -->
<div class="panel-title box-title">
    <span><strong><?=yii::t('common','Words and phrases') ?></strong></span>
    <span class="pull-right"><a href="#" class="font-12"><?=yii::t('common','More than') ?></a></span>
</div>

<div class="panel-body">
    <form action="/" id="w0" method="post">
        <div class="form-group input-group field-feed-content required">
            <textarea id="feed-content" class="form-control" name="content" placeholder="<?=yii::t('common','I leave a message')?>" rows="" cols=""></textarea>
            <span class="input-group-btn">
            <button type="button" data-url="<?=Url::to(['site/add-feed'])?>" class='btn btn-success btn-feed j-feed'><?=yii::t('common','release')?></button>
                
                
            </span> 
        </div>
    </form>

<?php if (!empty($data['feed'])):?>
    <ul class="media-list media-feed feed-index ps-container ps-active-y">
        <?php foreach ($data['feed'] as $list):?>
        <!--提取信息-->
        <?php
        $id = $list['user']['id'];
        $file_path = "image/userAvatar/$id.txt";
        if(file_exists($file_path)){
            $str = file_get_contents($file_path);
            if($str == null || $str == "" || $str == ''){
               $str = \Yii::$app->params['avatar']['small'];
              }
        }else $str = \Yii::$app->params['avatar']['small'];
        ?>
        
        <li class="media">
            <div class="media-left"><a href="<?= Url::to([ 'member/index-site','id'=> $id]) ?>" rel="author" data-original-title="" title="">
            <img alt="" class="avatar-img" style="width:37px;height:37px;" src="<?php echo $str;  ?> "/></a></div>
            <div class="media-body">
                <div class="media-content">
                    <a href="#" ><?=$list['user']['username']?>: </a>
                    <span><?=$list['content']?></span>
                </div>
                <div class="media-action">
                    <?php date_default_timezone_set('PRC');?>
                    <?=date('Y-m-d H:i:s',$list['created_at'])?>
                </div>
            </div>
            
        </li>
        <?php endforeach;?>
    </ul>
    <?php endif;?>
</div>
</div>