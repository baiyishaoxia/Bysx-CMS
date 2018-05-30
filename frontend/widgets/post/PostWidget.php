<?php
namespace frontend\widgets\post;

/**
 * 文章列表组件
 */
use yii;
use yii\base\Widget;
use common\models\PostModel;
use frontend\models\PostForm;
use yii\helpers\Url;
use yii\data\Pagination;

class PostWidget extends Widget
{    
    /**
     * 文章列表标题
     * @var string
     */
     public $title='';
     
     /**
      * 显示条数
      * @var integer
      */
     public $limit=8;
      
     /**
       * 是否显示更多
       * @var boolean
       */
     public $more =true;
       
     /**
      * 是否显示分页
      * @var boolean
      */
     public $page =true;

     public function run()
		{  
			 $curPage= Yii::$app->request->get('page',1);
			 //查询条件
			 $cond =['=','is_valid',PostModel::IS_VALID];
			 //参数：条件、当前页、每页显示数
			 $res =PostForm::getList($cond,$curPage,$this->limit);
			 $result['title'] = $this->title?:yii::t('common','The latest article');
			 $result['more']=Url::to(['post/index']);
			 $result['body']=$res['data']?:[];
			 //是否显示分页(参数：总条数、每页条数)
			 if($this->page){
			 	$pages=new Pagination(['totalCount'=>$res['count'],'pageSize'=>$res['pageSize']]);
			 	$result['page']= $pages;
			 }
			return $this->render('index',['data'=>$result]);
		}
}