<?php
use yii\helpers\Url;
?>
<div class="panel-title box-title">
    <span><strong><?=$data['title']?></strong></span>
    <?php if($this->context->more):?>
    <span class="pull-right"><a href="<?=$data['more']?>" class="font-12"><?=yii::t('common','More than') ?></a></span>
    <?php endif;?>
</div>

<div class="panel-body padding-left-0">
    <div class="tag-cloud">
        <?php foreach ($data['body'] as $list):?>
		<a href="<?=Url::to(['search/index','tag'=>$list['tag_name']])?>"><?=$list['tag_name']?></a>
	<?php endforeach;?>
    </div>
</div>