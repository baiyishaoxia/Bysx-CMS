<?php 

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\PostModel;
use yii\base\Object;
use common\models\RelationPostTagModel;
use yii\db\Query;

/*
 *文章表单模型
 */
class  PostForm extends Model
{
   public $id;
   public $title;
   public $content;
   public $label_img;
   public $tags;
   public $cat_id;
   public $_lastError="";
   
  
   /*
   *定义场景
   * const SCENARIOS_CREATE='create'; 创建场景
     const SCENARIOS_UPDATE='update'; 更新场景
    */
   const SCENARIOS_CREATE='create';
   const SCENARIOS_UPDATE='update';
  /**
   * 定义事件
   * const EVENT_AFTER_CREATE="eventAfterCreate";创建之后的事件
   * const EVENT_AFTER_UPDATE="eventAfterUpdate";更新之后的事件
   */
   const EVENT_AFTER_CREATE="eventAfterCreate";
   const EVENT_AFTER_UPDATE="eventAfterUpdate";
   /*
    *重写场景设置
    */
   public function scenarios()
   {
    $scenarios=[
       self::SCENARIOS_CREATE=>['title','content','label_img','cat_id','tags'], //场景需要用到的字段
       self::SCENARIOS_UPDATE=>['title','content','label_img','cat_id','tags'],
    ];
    return array_merge(parent::scenarios(),$scenarios); //把(继承父类)两个数组合并为一个数组
   }

   public function rules(){
  	 return[
       [['id','title','content','cat_id'],'required'],
       [['id','cat_id'],'integer'],
       ['title','string','min'=>4,'max'=>50],
  	 ];
  }
   public function attributeLabels()
    {
        return[
            'id'=>Yii::t('common','id'),
            'title'=>Yii::t('common','title'),
            'content'=>Yii::t('common','content'),
            'label_img'=>Yii::t('common','label_img'),
            'tags'=>Yii::t('common','tags'),
            'cat_id'=>Yii::t('common','cat_id'),
       ];  
    } 
    
    /**
     * 文章列表获取数据
     * @param  [type]  $cond     [查询条件]
     * @param  integer $curPage  [当前页]
     * @param  integer $pageSize [每页显示数]
     * @param  [type]  $orderBy  [排序方式]
     */
    public static  function getList($cond,$curPage=1,$pageSize =5 ,$orderBy=['id'=>SORT_DESC])
    {
      $model = new PostModel();
      //查询字段
      $select =['id','title','summary','label_img','cat_id','user_id','user_name','is_valid','created_at','updated_at'];
      //执行
      $query=$model->find()->select($select)->where($cond)->with('relate.tag','extend')->orderBy($orderBy);
      //获取分页数据
      $res = $model->getPages($query,$curPage,$pageSize);
      //数据格式化
      $res['data'] = self::_formatList($res['data']);
      return $res;
    }
    /**
     * 热门文章获取
     */
    public static function getHotList($cond,$curPage=1,$pageSize =5 ,$orderBy=['browser'=>SORT_DESC]){
      $model = new PostModel();
      //查询字段
      $select =['a.id','title','summary','label_img','cat_id','user_id','user_name','is_valid','created_at','updated_at','browser'];
      //执行
      $query = (new \yii\db\Query())->select($select)
                                    ->from('posts as a')
                                    ->leftJoin('post_extends as b','b.post_id = a.id')
                                    ->where($cond)
                                    ->orderBy($orderBy);
      //var_dump($query->all());die;
      //获取分页数据(参数：sql、当前页、每页条数、附加条件、数组形式)
      $res = $model->getPages($query,$curPage,$pageSize,'','array');
      //数据格式化
      $res['data'] = self::_formatList($res['data']);
      return $res;
    }

    /**
     * 数据格式化
     * @return [type] [description]
     */
    public static function _formatList($data)
    {
      //在 $list 之前加上 & 来修改数组的元素。此方法将以引用赋值而不是拷贝一个值。
      foreach ($data as &$list) {
         $list['tags']=[];
         if(isset($list['relate'])&& !empty($list['relate'])){
            foreach($list['relate'] as $lt){
               $list['tags'][] = $lt['tag']['tag_name'];
             }
         }
         unset($list['relate']);
      }
      return $data;
    }

  /*
   *文章创建
   */
   public function create()
   {
    //事务的使用(保证数据的完整性:文章+标签)
    $transation = Yii::$app->db->beginTransaction();
    try{
      //业务逻辑
      $model =new PostModel();
      $model->setAttributes($this->attributes); //获取前面的属性(与场景内同步)
      $model->summary = $this->_getSummary(); //简介
      $model->user_id=Yii::$app->user->identity->id; //用户id
      $model->user_name=Yii::$app->user->identity->username; //用户名
      $model->is_valid =PostModel::IS_VALID; //发布状态
      $model->created_at=time(); //创建时间
      $model->updated_at=time(); //更改时间
      if(!$model->save()){
           throw new \Exception('文章保存失败');
      }
      
      $this->id =$model->id;
      //调用事件
      $data =array_merge($this->getAttributes(),$model->getAttributes());
      $this->_eventAfterCreate($data);

      $transation->commit(); //事务提交
        return true;
    }catch(\Exception $e){
      //捕获错误(事务回滚)
      $transation->rollBack();
      //记住错误
      $this->_lastError = $e->getMessage();
      return false;
    }
   }

   //获取具体文章详情
   public function getViewById($id)
   {
     $res = PostModel::find()->with('relate.tag','extend')->where(['id'=>$id])->asArray()->one();
     if(!$res)
     {
      throw new \NotFoundHttpException("文章不存在！");
      
     }
      //处理标签格式
      $res['tags'] =[];
      if(isset($res['relate'])&&!empty($res['relate'])){
         foreach ($res['relate'] as $list) {
           $res['tags'][] = $list['tag']['tag_name'];
         }
      }
      unset($res['relate']); //去除没用的数据
      //print_r($res);
      return $res;
   }

    /**
     *截取文章摘要
     */
     private function _getSummary($s=0,$e=90,$char='utf-8')
     {
      if(empty($this->content))
        return null;
      //替换空格、去除标签
      return(mb_substr(str_replace('&nbsp;','',strip_tags($this->content)), $s,$e,$char));
     }

   /**
    * 文章创建之后的事件
    */
     public function _eventAfterCreate($data)
     {
          //添加事件
          $this->on(self::EVENT_AFTER_CREATE,[$this,'_eventAddTage'],$data);
          //触发事件
          $this->trigger(self::EVENT_AFTER_CREATE);
     }

    /**
     * [_eventAddTage description] 添加标签tags
     * @return [type] [description]
     */
     public function _eventAddTage($event)
     {     
            //保存标签
            $tag =new TagForm();
            $tag->tags=$event->data['tags'];
            $tagids = $tag->saveTags();

            //删除文章原先的关联关系
            RelationPostTagModel::deleteAll(['post_id' => $event->data['id']]);

            //批量保存文章和标签的关联关系
            if(!empty($tagids)){
              foreach($tagids as $k=>$id){
                $row[$k]['post_id'] = $this ->id;
                $row[$k]['tag_id'] = $id;
              }
              //批量插入、batchInsert() 里面有三个参数: 表名、要插入的表字段数组、要插入的表数据 
              $res =(new Query())->createCommand()
              ->batchInsert(RelationPostTagModel::tableName(),['post_id','tag_id'],$row)
              ->execute();
              //返回结果
            if(!$res)
              throw new \Exception("关联关系保存失败！");
            }     
     }











}