<?php

namespace common\models;

use Yii;
use common\models\UserModel;
/**
 * This is the model class for table "comment_extends".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property string $email
 * @property integer $post_id
 * @property integer $parent_id
 * @property integer $user_id
 * @property integer $remind
 *
 * @property Comment $parent
 * @property Posts $post
 * @property User $user
 */
class CommentExtendsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'email', 'post_id', 'parent_id', 'user_id'], 'required'],
            [['content'], 'string'],
            [['status', 'create_time', 'post_id', 'parent_id', 'user_id', 'remind'], 'integer'],
            [['title', 'email'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'status' => 'Status',
            'create_time' => 'Create Time',
            'email' => 'Email',
            'post_id' => 'Post ID',
            'parent_id' => 'Parent ID',
            'user_id' => 'User ID',
            'remind' => 'Remind',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Comment::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Posts::className(), ['id' => 'post_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    

    /**
     * 子回复关联的用户
     */
    public function getExuser()
    {
        return $this->hasOne(UserModel::className(), ['id' => 'user_id']);
    }
    
    /**
     * 评论处理
     */
    public function dealReply($data){
        $model = new CommentExtendsModel();
        $model->title = $data['title'];
        $model->content = $data['content'];
        $model->post_id = $data['post_id'];
        $model->parent_id = $data['parent_id'];
        $model->status = $data['type'];
        $userMe = UserModel::findOne(Yii::$app->user->id);
        $model->email = $userMe->email;
        $model->user_id = $userMe->id;
        if($model->save()){
            $this->countReply($data['post_id']);
            return 1;
        }else{
            return 0;
        } 
    }
    
    /**
     * 用户评论后立即更新评论数
     */
    private function countReply($id){
        $comment = new CommentModel();
        $count_ct = $comment::find()->where(['post_id'=>$id])->count();
        $count_ex= CommentExtendsModel::find()->where(['post_id'=>$id])->count();
        $post_extends = PostExtendModel::find()->where(['post_id'=>$id])->one();
        $post_extends->comment = ($count_ct+$count_ex);
        $post_extends->save();
    }

    
    /**
     * 保存之前将时间初始化
     */
    public function beforeSave($insert)
    {
    	if(parent::beforeSave($insert))
    	{
    		if($insert)
    		{
    			$this->create_time=time();
    		}
    		return true;
    	}
    	else  return false;
    }
}
