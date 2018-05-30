<?php
namespace frontend\controllers;

use common\models\SearchModel;
use frontend\controllers\base\BaseController;

class SearchController extends BaseController
{
    public function actionIndex($tag)
    {   
        $model = new SearchModel();
        $data = $model->SearchList($tag);
        //var_dump($data);die;
        return $this->render('index',['data'=>$data]);
    }

}
