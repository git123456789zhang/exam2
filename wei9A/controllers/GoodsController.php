<?php

namespace app\controllers;

use app\models\Goods;
use yii\web\Controller;

class GoodsController extends Controller{
    public $enableCsrfValidation = false;
    //公众号展示
    //考虑一下数组是几维的
    public function actionShow(){
        /*建立一个数据库查询来获得所有的文章状态= 1
        $query = Article::find()->where(['status' => 1]);
        //获取文章的总数(但不获取文章数据)
        $count = $query->count();
        //创建一个分页对象的总数
        $pagination = new Pagination(['totalCount' => $count]);
        //限制使用分页查询和检索的文章
        $articles = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
*/
        $query= \Yii::$app->db->createCommand("select * from wei_gong")->queryAll();
//        print_r($arr);die;
        return $this->render('show',['date'=>$query]);
    }
    //公众号添加页面
    public function actionAdd(){
       return $this->render('add');
    }
    //添加入库
    public function actionAdd1(){
        $requesr=\Yii::$app->request;
        $g_name=$requesr->post("g_name");
        $g_app=$requesr->post("g_app");
        $g_number= $requesr->post('g_number');
        $arr= \Yii::$app->db->createCommand()->insert("wei_gong",[
            "g_name"=>"$g_name",
            "g_app"=>"$g_app",
            "g_number"=>"$g_number",
        ])->execute();
        if($arr){
            $this->redirect('index.php?r=goods/show');
        }
    }
    //商品删除
    public function actionDel(){
        $requesr=\Yii::$app->request;
        $id= $requesr->get('id');
//    print_r($id);
        $arr= \Yii::$app->db->createCommand()->delete('wei_gong',['g_id'=>$id])->execute();
        if($arr){
            $this->redirect('index.php?r=goods/show');
        }
    }
    //修改 ------查询
    public function actionUp(){
        $requesr=\Yii::$app->request;
        $id= $requesr->get('id');
        $arr= \Yii::$app->db->createCommand("select * from wei_gong where g_id=$id")->queryOne();
        return    $this->render('up',$arr);
    }
    //修改---修改数据
    public function actionUp_pro(){
        $requesr=\Yii::$app->request;
        $g_id=$requesr->post("g_id");
//        echo $g_id;die;
        $g_name=$requesr->post("g_name");
        $g_app=$requesr->post("g_app");
        $g_number= $requesr->post('g_number');
//        echo $g_number;die;
        $arr= \Yii::$app->db->createCommand()->update("wei_gong",[
            "g_name"=>"$g_name",
            "g_app"=>"$g_app",
            "g_number"=>"$g_number",
        ],"g_id='$g_id'")->execute();
//        print_r($arr);die;
        if($arr){
            $this->redirect("index.php?r=goods/show");
        }else{
            $this->redirect("index.php?r=goods/show");
        }
    }
}