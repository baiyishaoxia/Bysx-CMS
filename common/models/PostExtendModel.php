<?php

namespace common\models;

use Yii;
use common\models\base\BaseModel;
/**
 * This is the model class for table "post_extends".
 *
 * @property integer $id
 * @property integer $post_id
 * @property integer $browser
 * @property integer $collect
 * @property integer $praise
 * @property integer $comment
 * 文章扩展表
 */
class PostExtendModel extends BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post_extends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'browser', 'collect', 'praise', 'comment'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'browser' => Yii::t('app', 'Browser'),
            'collect' => Yii::t('app', 'Collect'),
            'praise' => Yii::t('app', 'Praise'),
            'comment' => Yii::t('app', 'Comment'),
        ];
    }
   
   /**
    *更新文章统计
    *@param $cond:post_id 文章id
    *@param $attibute:browser 浏览次数
    *@param $num:1
    */
   public function upCounter($cond,$attibute,$num)
   {
     $counter= $this->findOne($cond);
     if(!$counter){
       //不存在就创建
       $this->setAttributes($cond);
       $this->$attibute=$num;
       $this->save();
     }else{
        //存在更新浏览次数：$attibute每次加$num次
        $countData[$attibute] =$num;
        $counter->updateCounters($countData);
     }
   }





}
