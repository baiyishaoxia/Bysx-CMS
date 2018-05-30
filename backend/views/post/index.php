<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use common\models\CatsModel;
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ''.yii::t('backend', 'Content Model').'';
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = ''.yii::t('backend', 'Post Model').'';
?>
<div class="">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
         // [ 'class' => 'yii\grid\SerialColumn'],
          'id',
          'title'=>[
                    'attribute' => 'title',
                    //将html标签不过滤掉
                    'format' =>'raw',
                    'value' => function($model){
                      return '<a href="'.Yii::t('backend','frontend_url').''.Url::to(['post/view','id'=>$model->id]).'" target="_blank">'.$model->title.'</a>';
                    }
                   ],
            'summary'=>[
                 'attribute' => 'summary',
                 'value' => function($model){
                      return  StringHelper::truncate($model->summary,20,'...'); //截取字符串
                 }
            ], 
            //'content:ntext',
            //'label_img',
            'cat_name'=>[
                 'attribute' => 'cat_name',
                 'value'=>'cat.cat_name',
            ],
            // 'user_id',
            'user_name',
            'is_valid'=>[
                 'attribute' => 'is_valid',
                 'value'=>function($model){
                    return ($model->is_valid==1)?'有效':'无效';
                   },
                 //搜索框的过滤
                 'filter'=>['1'=>'有效','0'=>'无效'],
                ],
            'created_at:datetime',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
             'header'=>''.Yii::t('backend','operation').'',   
             'headerOptions' => ['width' => '80'],
            ],
        ],


    ]); ?>

</div>
