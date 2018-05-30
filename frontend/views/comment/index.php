<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comment Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comment-model-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Comment Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'content:ntext',
            'status',
            'create_time:datetime',
            'userid',
            // 'email:email',
            // 'url:url',
            // 'post_id',
            // 'remind',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
