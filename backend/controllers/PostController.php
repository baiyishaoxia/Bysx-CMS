<?php

namespace backend\controllers;

use Yii;
use common\models\PostModel;
use common\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * PostController implements the CRUD actions for PostModel model.
 */
class PostController extends Controller
{
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
                    'delete' => ['post'],
                ],
            ],
        ];
    }
    /**
     * 插件扩展函数
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

    /**
     * Lists all PostModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PostModel model.
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
     * Creates a new PostModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PostModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PostModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PostModel model.
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
     * Finds the PostModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PostModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
