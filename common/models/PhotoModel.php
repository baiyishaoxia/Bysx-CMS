<?php

namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $picture
 * @property integer $created_at
 * @property string $name
 * @property string $introduction
 */
class PhotoModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'picture', 'created_at'], 'required'],
            [['user_id', 'created_at'], 'integer'],
            [['picture', 'name', 'introduction'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'picture' => '图片上传',
            'created_at' => 'Created At',
            'name' => 'Name',
            'introduction' => 'Introduction',
        ];
    }
    //关联表，相册表与用户之间的联系（获取用户名）
    public function getUser(){
        return $this->hasMany(UserModel::className(),['id'=>'user_id']);
    }

    
}
