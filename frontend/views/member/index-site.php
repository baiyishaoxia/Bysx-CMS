<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = ''.yii::t('common','个人主页').'';

$this->params['breadcrumbs'][]=['label'=>$this->title];
?>

 <div class="row usercenter-row" style="border:1px solid #ddd;margin:0 0 40px;padding:23px 0 0;">

<!--  个人基本信息  -->
    <div class="col-lg-9">
        <div class="panel panel-default user-head">
                   <?php if(!empty($data)):?>  
                    <div class="panel-body" style="padding:0;">
                        <div class="media media-profile" style="margin:0;">
                            <div class="media-left j_Userid" user-id="5252"><img class="head-img" src="<?=$data['avatar_img'] ?>"></div>
                            <div class="media-body">
                                <span class="media-heading font-16"><?=$data['username']?>（会员ID：<?=$data['id']?>）</span><br>
                                <span class="font-12 C888"><b>邮箱</b>：<?=$data['email']?>&nbsp;&nbsp; <b>注册时间</b>：<?= date('Y-m-d',$data['created_at'])?>&nbsp;&nbsp; <b>所在地：</b><?=$data['user']['city']?:'未设置'?>&nbsp;&nbsp;
                                <b>所在公司：</b><?=$data['user']['company']?:'未填写'?></span><br>
                                <span class="font-12 C888"><b>等级</b>：<?=$data['vip']['lv']?:0?> 级&nbsp;&nbsp; <b>VIP</b>：<?=$data['vip']['name']?:'未分配'?>&nbsp;&nbsp;</span><br>
                                <span class="font-12"><i class="fa fa-comment"></i>&nbsp;&nbsp;个性签名：<?=$data['user']['signature']?:'未设置'?></span>
                            </div>
                        </div>
                    </div>
                  <?php endif; ?>
                  <?php if(empty($data)):?>
                        <div class="panel-body" style="padding:0;">
                            <div class="media media-profile" style="margin:0;">
                                <h2>该用户未注册或已被管理员注销！</h2>
                            </div>
                        </div>
                  <?php endif;  ?>

         </div>
    </div>
<!--右侧信息-->
    <div class="col-lg-3">
        <div>
            <div id="w2" class="progress">
                <div class="progress-bar-success progress-bar" style="width:50%">
                    
                </div>
              <span class="sr-only">经验值&nbsp;&nbsp;10/20</span>
            </div>
        </div>
        
        <div class="board">
            <span>金币<br><em class="txt-orange">10</em></span>
            <span>名望<br><em class="txt-green">0</em></span>
            <span>易币<br><em class="txt-blue">0</em></span>
        </div>
    </div>
 </div>

    <div class="row usercenter-row">
<!-- 关注粉丝       -->
    <div class="col-lg-3" style="margin:0;">
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title pull-left">关注 <span class="badge">0</span></h2>
                <span class="pull-right"><a href=""></a></span>
            </div>
            <div class="panel-body padding11">
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title pull-left">粉丝 <span class="badge">0</span></h2>
                <span class="pull-right"><a href=""></a></span>
            </div>
            <div class="panel-body padding11">
            </div>
        </div>
        
    </div>
<!--个人动态-->
    <div class="col-lg-9">
    <ul id="myTab" class="nav nav-tabs">
           <li class="active"><a href="#do" data-toggle="tab">动态</a></li>
           <li><a href="#tutorial" data-toggle="tab">教程</a></li>
           <li><a href="#plugin" data-toggle="tab">扩展</a></li>
           <li><a href="#other" data-toggle="tab">相关文章</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
           <div class="tab-pane fade in active" id="do">
           暂无数据
           </div>
           <div class="tab-pane fade" id="tutorial">
           暂无数据
           </div>
           <div class="tab-pane fade" id="plugin">
           暂无数据
           </div>
           <div class="tab-pane fade" id="other">
           暂无数据
           </div>
        </div>

    </div>


</div>