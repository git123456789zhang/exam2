<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller{
    public $enableCsrfValidation = false;

    public $layout='main';

    /*
     *
     */

    /*
     * 后台主页
     */
    public function actionIndex(){
        return $this->render('index');
    }
}
