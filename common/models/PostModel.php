<?php

namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $summary
 * @property string $content
 * @property string $label_img
 * @property integer $cat_id
 * @property integer $user_id
 * @property string $user_name
 * @property integer $is_valid
 * @property integer $created_at
 * @property integer $updated_at
 */
class PostModel extends BaseModel
{    

     const IS_VALID='1';//发布
     const NO_VALID='0';//未发布
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }
    
    //关联表(relation_post_tags),文章与标签的关联，在PostForm中用到getViewById方法里面with('relate')
    public function getRelate()
    {
        return $this->hasMany(RelationPostTagModel::className(),['post_id'=>'id']);
    }
    //关联表postextend，用于文章统计显示，例如浏览次数
    public function getExtend(){
        return $this->hasOne(PostExtendModel::className(),['post_id'=>'id']);
    }
    //关联表，用于文章对应的分类信息
    public function getCat(){
        return $this->hasOne(CatsModel::className(),['id'=>'cat_id']);
    }
    //关联表，用户文章与用户之间的联系（获取用户名）
    public function getUser(){
        return $this->hasOne(UserModel::className(),['id'=>'user_id']);
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['cat_id', 'user_id', 'is_valid', 'created_at', 'updated_at'], 'integer'],
            [['title', 'summary', 'label_img', 'user_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('backend', 'Title'),
            'summary' => Yii::t('backend', 'Summary'),
            'content' => Yii::t('backend', 'Content'),
            'label_img' => Yii::t('backend', 'Label Img'),
            'cat_id' => Yii::t('backend', 'Cat ID'),
            'cat_name'=>Yii::t('backend', 'cat_name'),
            'user_id' => Yii::t('backend', 'User ID'),
            'user_name' => Yii::t('backend', 'User Name'),
            'is_valid' => Yii::t('backend', 'Is Valid'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_at' => Yii::t('backend', 'Updated At'),
        ];
    }
}
