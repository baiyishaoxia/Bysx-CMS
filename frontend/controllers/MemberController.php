<?php

namespace frontend\controllers;

use Yii;
use common\models\UserModel;
use common\models\UserExtendsModel;
use frontend\controllers\base\BaseController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


class MemberController extends BaseController
{   

    public function behaviors()
    {
        return [
           
           'access' => [
                'class' => AccessControl::className(),
                'only' => ['set-data', 'update','upload','crop'],
                'rules' => [
                    [
                        'actions' => ['set-data'],
                        'allow' => true,
                        
                    ],
                    [
                        'actions' => ['update','upload','crop'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    '*' => ['post','get'],
                ],
            ],


        ];
    }
    
  //扩展组件应用
public function actions()
{
    return [
        'crop'=>[
            'class' => 'common\widgets\avatar\CropAction',
            'config'=>[
                'bigImageWidth' => '200',     //大图默认宽度
                'bigImageHeight' => '200',    //大图默认高度
                'middleImageWidth'=> '100',   //中图默认宽度
                'middleImageHeight'=> '100',  //中图图默认高度
                'smallImageWidth' => '50',    //小图默认宽度
                'smallImageHeight' => '50',   //小图默认高度
                //头像上传目录（注：目录前不能加"/"）
                'uploadPath' => 'image/avatar/photo',
            ]
        ],
        'upload'=>[
                'class' => 'common\widgets\file_upload\UploadAction',     //这里扩展地址别写错
                'config' => [
                    'imagePathFormat' => "/image/avatar/user/{time}{rand:6}",
                ]
            ],
    ]; 
}
   /**
    * 账户设置
    */
    public function actionSet()
    {   
       echo $this->getSetData();
    }
    
    
    /**
     * 头像设置
     */
    public function actionSetAvatar()
    {  
        return $this->render('index');
    }
    /**
     * 个人中心
     */
    public function actionSetData(){
        echo $this->getSetData();
    }
    
    /**
     * 个人中心实现
     */
    private function getSetData(){
        $user_id = Yii::$app->user->identity->id ;
        $model = new UserExtendsModel();
        if ($model->load(Yii::$app->request->post())) {
            $flag = UserExtendsModel::find()->where(['user_id'=>$user_id])->one();
            if($flag){
                $flag->real_name = $model['real_name'];
                $flag->sex = $model['sex'];
                $flag->qq = $model['qq'];
                $flag->tel_phone = $model['tel_phone'];
                $flag->city = $model['city'];
                $flag->company = $model['company'];
                $flag->signature = $model['signature'];
                $flag->save();
                return $this->render('set-data',['model' => $flag]);
            }else{
                $model->user_id = $user_id;
                $model->save();
                return $this->render('set-data',['model' => $model]);
            }
        } else {
            $flag = UserExtendsModel::find()->where(['user_id'=>$user_id])->one();
            if($flag){
                 return $this->render('set-data', ['model' => $flag]);
            }else{
                 return $this->render('set-data', ['model' => $model]);
            }
        }
    }

    /**
     * 更改用户头像
     */
    public function actionSaveAvatar(){
         $imgsrc = $_COOKIE['imgsrc'];
         $id = \Yii::$app->user->id;
         $model = new UserModel();
         $model = $model::find()->select('id,avatar_img')->where(['id'=>$id])->one();
         $model->avatar_img = $imgsrc;
         if(!$model->save()){
             throw new \NotFoundHttpException("更改用户头像失败！");
         }
        // var_dump($model['avatar']);die;
        $avatar = $model['avatar_img'];
        $file = fopen("image/userAvatar/$id.txt","w");
        fwrite($file,"$avatar");
        fclose($file);
        $this->redirect("set-avatar".\Yii::$app->params['suffix']);  

    }
    
    
   /**
     * Updates an existing UserModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    //自定义上传更新头像
    public function actionUpdate()
    {   
        $id=Yii::$app->user->identity->id;
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {  
           //print_r(Yii::$app->request->post());die;
         $file = fopen("image/userAvatar/$id.txt","w");
         fwrite($file,$model['avatar_img']);
         fclose($file);
         return $this->redirect("set-avatar".\Yii::$app->params['suffix']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    /**
     * 修改密码
     */
    public function actionSetPassword(){
         $id = Yii::$app->user->identity->id ;
         $msg ='';
         $model = new UserModel();
         $model->password_hash='';
         if ($model->load(Yii::$app->request->post())) {  
             $model['oldPassword'] = $_POST['UserModel']['oldPassword'];
             $model['newPassword'] = $_POST['UserModel']['newPassword'];
             $model['rePassword'] = $_POST['UserModel']['rePassword'];
             if(empty($model['newPassword']) || empty($model['newPassword']) || empty($model['newPassword']) ){
                 $msg="旧密码或新密码不能为空！";
                 return $this->render('set-password',['model'=>$model,'msg'=>$msg]);
             }
             if($model['newPassword'] != $model['rePassword']){
                 $msg="两次密码输入不一致！";
                 return $this->render('set-password',['model'=>$model,'msg'=>$msg]);
             }
             $res = UserModel::find()->select('password_hash')->Where(['id'=>$id])->one();
             $password_old_hash = $res['password_hash'];
             $bool = Yii::$app->security->validatePassword($model['oldPassword'], $password_old_hash);
             $newPassword = $model['newPassword'];
             //var_dump($model);
             if($bool){
                 //验证成功
                 $model = $model::find()->select('id,username,auth_key,password_hash')->where(['id'=>$id])->one();
                 $model->password_hash = Yii::$app->security->generatePasswordHash($newPassword);
                 $model->auth_key = Yii::$app->security->generateRandomString();
                 $model->save();
                 $this->redirect("set-password".\Yii::$app->params['suffix']);  
             }else{
                 $msg="原密码错误！";
                 return $this->render('set-password',['model'=>$model,'msg'=>$msg]);
             }
         }else{
         return $this->render('set-password',['model'=>$model,'msg'=>$msg]);
         }
    }
    
    /**
     * 邮箱绑定
     */
    public function actionSetEmail()
    {   
        $id=Yii::$app->user->identity->id;
        $model = new UserModel();
        if ($model->load(Yii::$app->request->post())) { 
          $model = $model::find()->where(['id'=>$id])->one();
          $model->email = $_POST['UserModel']['email']; 
          $model->save();
          return $this->render('set-email', ['model' => $model]);
        } else {
            $model = $model::find() ->select('email')->where(['id'=>$id])->one();
            return $this->render('set-email', ['model' => $model]);
          }
    }
    
    /**
     * 个人主页
     */
    public function actionIndexSite($id){
        
        //提取信息
        
        $data = UserModel::find()->with('user','vip')->where(['id'=>$id])->andWhere(['status'=>'10'])->one();
        if(!empty($data)){
        $file_path = "image/userAvatar/$id.txt";
        if(file_exists($file_path)){
            $data['avatar_img'] = file_get_contents($file_path);
            if($data['avatar_img'] == null || $data['avatar_img'] == "" || $data['avatar_img'] == ''){
               $data['avatar_img'] = \Yii::$app->params['avatar']['small'];
              }
        }else {$data['avatar_img'] = \Yii::$app->params['avatar']['small'];}
        }else{
            $data = null;
        } 
        return $this->render('index-site',['data'=>$data]);
    }
    


        /**
     * Finds the UserModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
