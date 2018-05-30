<?php
namespace frontend\models;
use yii\base\Model;
use Yii;
use common\models\TagModel;

/** 
 * 标签的表单模型
 */
class TagForm extends Model
{
	public $id;
	public $tags;

	public function rules()
	{
		return[
		        ['tag','required'],
		        ['tags','each','rule'=>['string']], //tags(遍历、里面必须是字符串)
		      ];
	}

/**
 * 保存标签集合
 * tags是PostForm传递过来的tags数据
 * @return [type] [description]
 */
public function saveTags()
{
	$ids =[];
	if(!empty($this->tags)){
		foreach ($this->tags as $tag){
			$ids[] = $this->_saveTag($tag);
		}
	} 
	return $ids;
}

/**
 * 保存标签
 * @return [type] [description]
 */
private function _saveTag($tag)
{
	$model=new TagModel();
	//查询标签是否存在
	$res = $model->find()->where(['tag_name'=>$tag])->one();
	//新建标签
	if(!$res){
		$model->tag_name=$tag;
		$model->post_num =1;
		
		if(!$model->save()){
			throw new \Exception("保存标签失败！");
			
		}
		
		return $model->id;
	}else{
		//自动叠加(post_num+1)
		$res->updateCounters(['post_num'=>1]);
	}
	return $res->id;
}









}

?>