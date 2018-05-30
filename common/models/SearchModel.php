<?php

namespace common\models;

use Yii;
use common\models\base\BaseModel;
use common\models\PostModel;
use common\models\CatsModel;

/**
 *搜索模型
 */
class SearchModel extends BaseModel
{
   public function SearchList($condition){
       $data = [];
       //查询文章分类数据
       $cat_data = CatsModel::find()->where(["like","cat_name",$condition])->one();
       $cat_id = $cat_data['id'];
       $post_data = PostModel::find()->where(['cat_id'=>$cat_id])->all();
       //根据标签云与文章的关系查询
       $tag_data = TagModel::find()->where(['tag_name'=>$condition])->select('id')->one();
       $tag_id = $tag_data['id'];
       if(!empty($tag_id)){
            $RePostTag = RelationPostTagModel::find()->where(['in','tag_id',$tag_id])->all();
            foreach ($RePostTag as $k => $v){
                    $post_ids[] = $v['post_id']; 
                }
       }
       if(!empty($post_ids)){
           $data1 = PostModel::find()->with('cat','extend','user')->where(["in","id",$post_ids])->all();
       }else{//不存在
           $data1 = 0; 
       }
       //var_dump($data1);die;
       if($data1){
           return $data1;
       }
       //模糊查询
       $data2= PostModel::find()->with('cat','extend','user')->where(["like","title",$condition])
               ->orWhere(['like', 'content', $condition])
               ->all();
       if($data2){
           return $data2;
       }
       if($post_data){
          return $post_data; 
       }else{
           //找不到数据
           return $data;
       }    
   }
   
   
   
}

