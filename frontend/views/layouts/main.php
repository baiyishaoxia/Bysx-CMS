<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use vendor\oonne\scrollTop\ScrollTop;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('common','My space'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $leftmenu = [
        ['label' => Yii::t('common','Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('common','article'), 'url' => ['/post/index']],
        ['label' => Yii::t('common','Recent updates'), 'url' => ['/author/update']],
        ['label' => Yii::t('common','On this site'), 'url' => ['/author/about']],
    ];

    if (Yii::$app->user->isGuest) {
        $rightmenuItems[] = ['label' => Yii::t('common','Signup'), 'url' => ['/site/signup']];
        $rightmenuItems[] = ['label' => Yii::t('common','Login'), 'url' => ['/site/login']];
    } else {
            $str = Yii::$app->user->identity->avatar_img;
            if($str == null || $str == "" || $str == ''){
               $str = \Yii::$app->params['avatar']['small'];
              }
            else {$str = Yii::$app->user->identity->avatar_img;}

        $rightmenuItems[] = [
            // 'label' => '<img src="' .Yii::$app->params['avatar']['small']. '" alt="'. Yii::$app->user->identity->username .'"> ',
            'label' => '<img src="'.$str.'" alt="' . Yii::$app->user->identity->username . '"> ',
            'url' => ['#'],
            'linkOptions' => ['class' => 'avatar'],
            'items'=>[
                ['label'=>'<i class="fa fa-sign-in"></i>'.Yii::$app->user->identity->username.'' ],
                ['label'=>'<i class="fa fa-user"></i>'.Yii::t('common','Personal center'),'url'=>['member/set-avatar'],'linkOptions' => ['data-method' => 'post']],
                ['label'=>'<i class="fa fa-sign-out"></i>'.Yii::t('common','Exit'),'url'=>['/site/logout'],'linkOptions' => ['data-method' => 'post'] ],
            ]
            //'linkOptions' => ['data-method' => 'post']
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels'=>false,
        'items' => $leftmenu,
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels'=>false,
        'items' => $rightmenuItems,
    ]);    
    $searchUrl = Url::to(["search/index"]);
    echo '<form class="navbar-form navbar-right" action='.$searchUrl.' method="get">
                <div class="input-group">
                <input type="text" class="form-control" name="tag" value="" placeholder="全站搜索">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
                </div></form>';
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>

        <?= $content ?>
    </div>
   <!--回到顶部-->
        <?= ScrollTop::widget([
        'tagContent' => '<i class="fa fa-arrow-up"></i>',
        'options' => 'oonne-scroll-top',
        ]); ?>
</div>
<script>
       function changeLanguage(lang){
           $.cookie('language',lang);
           window.location.reload();
       }
</script>

<footer class="footer">
    <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
            <p align="center">
                    <?=Yii::t('common','Switch between Chinese and English:')?>
                      <a href="javascript:;" onclick="changeLanguage('en_US');">
                        <span><?php echo \Yii::t('common','English')?></span>
                      </a>
                      <a href="javascript:;" onclick="changeLanguage('zh-CN');">
                        <span><?php echo \Yii::t('common','Chinese')?></span>
                      </a>

             </p>
             <center>最终解释权归 白衣少侠 @版权所有2017-<?= date('Y') ?></center>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
