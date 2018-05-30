<?php 
namespace frontend\controllers;

use Yii;
use frontend\controllers\base\BaseController;
use frontend\models\PostForm;
use common\models\CatsModel;
use common\models\PostModel;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use common\models\PostExtendModel;
use common\models\VipModel;
use common\models\UserModel;
use common\models\CommentModel;
use common\models\CommentExtendsModel;

class PostController extends BaseController
{ 
      public $added=0; //0代表还没有新回复
     /**
      * 行为过滤
      * @return [type] [description]
      */
      public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create','upload','ueditor'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true, 
                        
                    ],
                    [
                        'actions' => ['create','upload','ueditor'],
                        'allow' => true,
                        'roles' => ['@'], //登陆之后能访问
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                      '*' =>['get','post'], //所有方法可以用'get','post'访问
                    //'create' => ['post'],
                ],
            ],
        ];
    }
/**
  *图片上传组件、百度编辑器组件
  */
public function actions()
    {
        return [
            'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/upload/{yyyy}{mm}{dd}/{time}{rand:6}",
                ]
            ],

           
        'ueditor'=>[
            'class' => 'common\widgets\ueditor\UeditorAction',
            'config'=>[
                //上传图片配置
                'imageUrlPrefix' => "", /* 图片访问路径前缀 */
                'imagePathFormat' => "/image/ueditor/{yyyy}{mm}{dd}/{time}{rand:6}", /* 上传保存路径,可以自定义保存路径和文件名格式 */
            ]
          ]
        ];
    }

    /*
     *文章列表
     *通过PostWidget组件实现输出
     */
	public function actionIndex()
	{   
            //获取用户等级
            $vip = new \common\models\VipModel();
            $vip_lv = $vip::getVip();
            return $this->render('index',['vip_lv'=>$vip_lv]);

	}
     /**
      * 热门文章
      */
       public function actionHot(){
           return $this->render('hot');
       }
    /*
     *创建文章
     *return string;
     */
	public function actionCreate()
	{
            $model=new PostForm();
            //定义场景
            $model->setScenario(PostForm::SCENARIOS_CREATE);
            if($model->load(Yii::$app->request->post()) && $model->validate()){
                if(!$model->create()){
                    Yii::$app->session->setFlash('warning', $model -> _lastError);
                }else{
                    return $this->redirect(['post/view', 'id' => $model->id]);
                }
        }
        //获取所有分类
        $cat=CatsModel::getAllCats();
        return $this->render('create',['model'=>$model,'cat'=>$cat]);
	}

  /**
   * 文章详情页
   */
 public function actionView($id)
 {  
    $model =new PostForm();
    $data = $model ->getViewById($id);
    
    //文章统计
    $model =new PostExtendModel();
    $model->upCounter(['post_id'=>$id],'browser',1);
    //会员信息
    $vip_lv = VipModel::getVip();
    //以下与评论有关
    $postmodel = PostModel::find()->where(['id'=>$id])->one();
    $commentModel = new CommentModel();

    if(!Yii::$app->user->isGuest){
        //处理数据
        $userMe = UserModel::findOne(Yii::$app->user->id);
        $commentModel->email = $userMe->email;
        $commentModel->userid = $userMe->id;
       
        //step2. 当评论提交时，处理评论
        if($commentModel->load(Yii::$app->request->post()))
        {      
            
                $commentModel->status = 1; //新评论默认状态为 pending
                $commentModel->post_id = $id;
                if($commentModel->save())
                {
                        $this->added=1;
                }
        }
    }
    //获取评论数据(全部)
    $comment = CommentModel::find()->with('user','extends.exuser')->where(['post_id'=>$id])->all();
    
    return $this->render('view',['data'=>$data,'vip_lv'=>$vip_lv,'added'=>$this->added,'commentModel'=>$commentModel,'postmodel'=>$postmodel,'comment'=>$comment]);
 }
 
 /**
  * 文章修改页
  */
 public function actionUpdate($id)
    {
        $model=new PostForm();
        $model->setScenario(PostForm::SCENARIOS_UPDATE);
        $model = PostModel::find()->with('relate.tag','extend')->where(['id'=>$id])->one();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $cat=CatsModel::getAllCats();
            return $this->render('update', [ 'model' => $model,'cat'=>$cat]);
        }

    }
   
        
        
        
        
 
 


}
 