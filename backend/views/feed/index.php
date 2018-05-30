<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FeedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ''.yii::t('backend', 'Content Model').'';
$this->title = ''.yii::t('backend','只言片语').'';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feed-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

             'id'=>[
                   'attribute'=>'id',
                   'contentOptions' => [  //设定组件的宽度
                        'width'=>'100'
                    ],
                  ],
           // 'user_id',
             'username'=>[
                 'attribute' => 'username',
                 'value'=>'user.username',
            ],
            'content'=>[
                 'attribute' => 'content',
                 'value' => function($model){
                      return  StringHelper::truncate($model->content,20,'...'); //截取字符串
                 }
            ],
            'created_at:datetime',

            ['class' => 'yii\grid\ActionColumn',
             'header'=>Yii::t('backend','operation'),
            ],
        ],
    ]); ?>

</div>
