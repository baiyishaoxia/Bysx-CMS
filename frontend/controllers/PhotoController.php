<?php
namespace frontend\controllers;

use Yii;
use frontend\controllers\base\BaseController;
use yii\data\Pagination;

class PhotoController extends BaseController
{

//扩展组件应用
public function actions()
{   $cookies = Yii::$app->request->cookies;
    return [
        'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',    
                'config' => [
                    'imagePathFormat' => "/image/avatar/photo/{$cookies->getValue('picture_img')}/{time}{rand:6}",
                ]
            ],
    ]; 
} 

    
    /**
     * 相册管理
     */
    public function actionIndex()
    {   
        $user_id=Yii::$app->user->identity->id;
        //$data = \common\models\PhotoModel::find()->with('user')->where(['user_id'=>$user_id])->all();
        $select =['id','user_id','picture','created_at'];
        $model = new \common\models\PhotoModel;
        $data=$model->find()->select($select)->where(['user_id'=>$user_id])->with('user')->orderBy(['id'=>SORT_DESC]);
        //获取分页数据
        $curPage= Yii::$app->request->get('page',1);
        $res = $model->getPages($data,$curPage,6);
        $pages=new Pagination(['totalCount'=>$res['count'],'pageSize'=>$res['pageSize']]);
        //获取页码
        $res['page']= $pages;
        return $this->render('index',['res'=>$res]); 

    }
    
    
    /**
     * 相册上传
     */
    public function actionSetPhoto(){
        $user_id=Yii::$app->user->identity->id;
        $data = \common\models\PhotoModel::find()->with('user')->where(['user_id'=>$user_id])->all();
        $cookies = Yii::$app->response->cookies; 
        $cookies->add(new \yii\web\Cookie([ 'name' => 'picture_img', 'value' => $data[0]['user'][0]['id'] ]));
        $model = new \common\models\PhotoModel();
        if ($model->load(Yii::$app->request->post())) {
           $model->user_id = $user_id;
           $model->picture = $_POST['PhotoModel']['picture'];
           $model->created_at=time();
           $model->save();
         return $this->redirect(['index']);
        } else {
         return $this->render('set-photo',['model' => $model,'data'=>$data]);
        }   
    }

}
