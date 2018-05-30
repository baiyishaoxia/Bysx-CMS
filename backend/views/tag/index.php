<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['breadcrumbs'][] = ''.yii::t('backend', 'Content Model').'';
$this->title = ''.yii::t('backend','Tag Models').'';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tag-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(''.yii::t('backend', 'Create Tag Model').'', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tag_name',
            'post_num',

            ['class' => 'yii\grid\ActionColumn',
             'header'=>Yii::t('backend','operation')
             ],
        ],
    ]); ?>

</div>
