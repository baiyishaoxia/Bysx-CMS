<?php
namespace frontend\controllers;

use frontend\controllers\base\BaseController;

/**
 * 关于本站
 */
class AuthorController extends BaseController
{
    public function actionUpdate()
    {   
        return $this->render('update');
    }
    public function actionAbout(){
        return $this->render('about');
    }

}
