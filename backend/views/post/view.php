<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $model common\models\PostModel */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => ''.yii::t('backend','Post Model').'', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(''.yii::t('backend','Update').'', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(''.yii::t('backend','Delete').'', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
           'summary'=>[
               'attribute'=>'summary',
               'value'=> StringHelper::truncate($model->summary,50,'...'),
           ],
            
  
            'content:ntext'=>[
               'attribute'=>'content',
               'value'=> StringHelper::truncate($model->content,150,'...'),
           ],
            'label_img'=>[
                'label'=>''.yii::t('backend','Label Img').'',
                'value'=>($model->label_img !=null)?:'无',
            ],
           // 'cat_id',
             [
            'label'=>''.yii::t('backend','cat_name').'',
            'value'=>$model->cat->cat_name,		
             ],
            'user_id',
            'user_name',
           // 'is_valid',
             [
            'label'=>''.yii::t('backend','Is Valid').'',
            'value'=>($model->is_valid==1)?'有效':'无效',		
             ],
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>
