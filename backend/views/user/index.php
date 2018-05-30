<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = ''.yii::t('backend', 'User Models').'';
$this->title = ''.yii::t('backend','The member information').'';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-model-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
 
             'id'=>[
                   'attribute'=>'id',
                   'contentOptions' => [  //设定组件的宽度
                        'width'=>'30'
                    ],
                  ],
             'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            // 'email_validate_token:email',
             'email:email',
            // 'role',
             'status'=>[
                'label' => '状态',
                'attribute' => 'status',
                'value' =>function($model){
                   return ($model->status == 10)?'激活':'非激活' ;
                },
                'filter' => ['0'=>'非激活','10'=>'激活'],
            ], 
            // 'avatar',
            // 'vip_lv',
               ['attribute'=>'vip_lv',
                'value'=>'vip.name',
                'filter'=> common\models\VipModel::find()            //自定义过滤条件输入框
                ->select(['name','id'])
                ->orderBy('lv')
                ->indexBy('id')
                ->column(),
                 ],
            // 'created_at:datetime',
               'created_at'=>[
                 'attribute'=>'created_at',
                 'value'=>function($model){
                    return  date('Y-m-d H:i:s',$model->created_at);  //初始化时间
                },
                 'headerOptions' => ['width' => '170'],
               ],
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn',
             'header' => ''.yii::t('backend','operation').'', 
             'template' => '{view} {update} {delete}',//只需要展示预览和更新、删除   
             'headerOptions' => ['width' => '150'],  //设定表格的宽度
             'buttons' => [
                          'delete' => function($url, $model, $key){
                            return Html::a('<i class="fa fa-ban"></i> '.yii::t('backend','Delete').'',
                                ['del', 'id' => $key], 
                                [
                                 'class' => 'btn btn-default btn-xs',
                                 'data' => ['confirm' => ''.yii::t('backend','Are you sure you want to delete this member?').'',]
                                ]
                           );
                         },                     
                       ],
            ],
        ],
    ]); ?>

</div>
