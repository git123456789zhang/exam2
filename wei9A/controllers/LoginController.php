<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use app\models\User;

class LoginController extends Controller{

    public $enableCsrfValidation = false;

    public function actionIndex(){
      $request=Yii::$app->request;
//        print_r($request);die;
        if(!$request->post()){
            return $this->renderPartial('index');
        }else{

            $u_name = $request->post('u_name');

            $pwd = md5($request->post('pwd'));
//            echo $pwd;die;
            $userData = User::find()->where(['uname'=>$u_name,'upwd'=>$pwd])->asArray()->one();
            if($userData){
                //设置cookie
                $cookies = YII::$app->response->cookies;
                $cookies->add(new Cookie([
                    'name' => 'uname',
                    'value' => $u_name,
                ]));
                //设置session
                $session = Yii::$app->session;
                $session->open();
                $session->set('uid', $userData['uid']);
                echo 1;die;
            }else echo 0;
        }
    }

    /*
     * 退出登录
     */
    public function actionLoginout(){
        $cookies = Yii::$app->response->cookies;
        $cookies->remove('uname');
        $session = Yii::$app->session;
        $session->open();
        $session->remove('uid');
        $this->redirect(['login/index']);
    }
}