<?php

namespace common\models;

use Yii;
use common\models\base\BaseModel;
use common\models\UserModel;

/**
 * This is the model class for table "vip".
 *
 * @property integer $id
 * @property string $name
 * @property integer $lv
 */
class VipModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lv'], 'integer'],
            [['name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lv' => 'Lv',
            'username'=>'username',
            'vip_lv'=>'vip_lv',
        ];
    }
    /**
     * 获取用户等级
     */
    public static function getVip(){
        $user_id = \Yii::$app->user->id;
            return UserModel::findOne($user_id);
    }

}
