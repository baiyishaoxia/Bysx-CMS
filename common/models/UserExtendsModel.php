<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_extends".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $real_name
 * @property string $sex
 * @property string $qq
 * @property string $tel_phone
 * @property string $city
 * @property string $company
 * @property string $signature
 */
class UserExtendsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['sex'], 'string'],
            [['real_name', 'city', 'company', 'signature'], 'string', 'max' => 255],
            [['qq'],'integer', 'message'=>'QQ号码必须是整数！'],
            [['tel_phone'], 'integer','message'=>'手机号码必须是整数！']
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
            'real_name' => yii::t('common','Real name'),
            'sex' => yii::t('common','Sex'),
            'qq' => yii::t('common','QQ'),
            'tel_phone' => yii::t('common','Mobile phone number'),
            'city' => yii::t('common','City'),
            'company' => yii::t('common','Company'),
            'signature' => yii::t('common','Individuality signature'),
        ];
    }
}
