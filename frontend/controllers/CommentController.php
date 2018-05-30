<?php

namespace frontend\controllers;

use Yii;
use common\models\CommentModel;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\CommentExtendsModel;

/**
 * CommentController implements the CRUD actions for CommentModel model.
 */
class CommentController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [   
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
    
   /**
    * 子评论处理
    */
   public function actionReply()
    {   

         $response = \Yii::$app->response;
         $response->format = \yii\web\Response::FORMAT_JSON;
         $data = \Yii::$app->request->post();

         //处理数据
         $model = new CommentExtendsModel();
         $res =$model->dealReply($data);
         if($res){
         $response->data = ['status'=>true,'msg'=>'回复成功','res'=>$res];
         $response->send();
         }else{
         $response->data = ['status'=>false,'msg'=>'回复失败','res'=>0];
         $response->send();    
         }
         
//         if($model->save()){
//            $response->data = ['status'=>true,'msg'=>'回复成功','res'=>$res];
//            $response->send();    
//         }else {
//         $response->data = ['status'=>false,'msg'=>'回复失败','res'=>$res];
//         $response->send();  
//         }

    
//处理回复数据        
//        if (Yii::$app->request->isAjax) {
//          $data = Yii::$app->request->post();
//          $post_id= explode(":", $data['post_id']);
//          $type= explode(":", $data['type']);
//          $title= explode(":", $data['title']);
//          $content= explode(":", $data['content']);
//          $parent_id= explode(":", $data['parent_id']);

//          $search = 'key';// your logic;
//          \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//          return [
//            'search' => $search,
//            'status' => true,
//          ];
//         }
//         $response->data = ['status'=>true,'msg'=>'数据成功',
//                            'da1'=>$data['title'],
//                            'da2'=>$data['content'],
//                            'da3'=>$data['post_id'],
//                            'da4'=>$data['parent_id'],
//                            'da5'=>$data['type']
//                           ];

    }

    /**
     * Lists all CommentModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CommentModel::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CommentModel model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CommentModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CommentModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CommentModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {  
        $model = $this->findModel($id);
        $id = $model['post_id'];
        $post = \common\models\PostModel::findOne($id);
        $post_title = $post['title'];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             return $this->redirect(['post/view', 'id' => $model->post_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'post_title'=>$post_title,
            ]);
        }
      
    }
    /**
     * Updates an existing CommentModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionEdit($id){
        $model = CommentExtendsModel::findOne($id);
        $id = $model['post_id'];
        $post = \common\models\PostModel::findOne($id);
        $post_title = $post['title'];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['post/view', 'id' => $model->post_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'post_title'=>$post_title,
            ]);
        }
    }

    /**
     * Deletes an existing CommentModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CommentModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CommentModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CommentModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
