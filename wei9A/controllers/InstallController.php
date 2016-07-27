<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class InstallController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex(){
       //安装界面如果安装好之后生成一个php文件 文件如果存在则跳到登录界面
        if(is_file("assets/existence.php")){
            $this->redirect(array('/login/index'));
        }else{
            return $this->renderPartial("one");
        }
    }
    public function actionOne(){
        header('Content-type:text/html;charset=utf8');
        $ret = array();
        $ret['server']['os']['value'] = php_uname();
        $ret['server']['sapi']['value'] = $_SERVER['SERVER_SOFTWARE'];
        $ret['server']['php']['value'] = PHP_VERSION;
//        $ret['server']['dir']['value'] = IA_ROOT;
        $ret['server']['upload']['value'] = @ini_get('file_uploads') ? ini_get('upload_max_filesize') : 'unknow';
        $ret['php']['version']['value'] = PHP_VERSION;
        $ret['php']['version']['class'] = 'success';
        $ret['php']['pdo']['ok'] = extension_loaded('pdo') && extension_loaded('pdo_mysql');
        $ret['php']['fopen']['ok'] = @ini_get('allow_url_fopen') && function_exists('fsockopen');
        $ret['php']['curl']['ok'] = extension_loaded('curl') && function_exists('curl_init');
        $ret['php']['ssl']['ok'] = extension_loaded('openssl');
        $ret['php']['gd']['ok'] = extension_loaded('gd');
        $ret['php']['dom']['ok'] = class_exists('DOMDocument');
        $ret['php']['session']['ok'] = ini_get('session.auto_start');
        $ret['php']['asp_tags']['ok'] = ini_get('asp_tags');

        return $this->renderPartial("index",['ret'=>$ret]);




    }
    public function actionTwo(){
        return $this->renderPartial("three");
    }
    public function actionCheck(){
        $post=\Yii::$app->request->post();
        $host=$post['dbhost'];

        $name=$post['dbname'];
        $pwd=$post['dbpwd'];
        $link= mysql_connect("$host","$name","$pwd");
//            print_r($link);die;
        $db=$post['db'];
       $uname=$post['uname'];
       $upwd=md5($post['upwd']);
		$dbtem=$post['dbtem'];
        if (@$link= mysql_connect("$host","$name","$pwd")){
//            echo 1;die;
            $db_selected = mysql_select_db("$db", $link);
                if($db_selected){
                    $sql="drop database ".$post['db'];
                    mysql_query($sql);
                }
                $sql="create database ".$post['db'];
                mysql_query($sql);


				$str = 'DROP TABLE IF EXISTS `'.$dbtem.'user`;
CREATE TABLE `'.$dbtem.'user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `upwd` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;';


            $arr=explode('-- ----------------------------',$str);
            $db_selected = mysql_select_db($post['db'], $link);
            for($i=0;$i<count($arr);$i++){
                if($i%2==0){
                    $a=explode(";",trim($arr[$i]));
                    array_pop($a);
                    foreach($a as $v){
                        mysql_query($v);
                    }
                }
            }


                $str="<?php
					return [
						'class' => 'yii\db\Connection',
						'dsn' => 'mysql:host=".$post['dbhost'].";port=3306;dbname=".$post['db']."',
						'username' => '".$post['dbname']."',
						'password' => '".$post['dbpwd']."',
						'charset' => 'utf8',
						'tablePrefix' => '".$post['dbtem']."',   //加入前缀名称
					];";
                file_put_contents('../config/db.php',$str);
            $str1="<?php
                \$pdo=new PDO('mysql:host= $host;port=3306;dbname=$db','$name','$pwd',array(PDO::MYSQL_ATTR_INIT_COMMAND=>'set names utf8'));
                   ?>";
            file_put_contents('./assets/abc.php',$str1);
               $sql="insert into ".$post['dbtem']."user (uname,upwd) VALUES ('$uname','$upwd')";
                mysql_query($sql);
            mysql_close($link);
            $counter_file       =   'assets/existence.php';//文件名及路径,在当前目录下新建aa.txt文件
            $fopen                     =   fopen($counter_file,'wb');//新建文件命令
            fputs($fopen,   '安装完成');//向文件中写入内容;
            fclose($fopen);
            $strs=str_replace("//'db' => require(__DIR__ . '/db.php'),","'db' => require(__DIR__ . '/db.php'),",file_get_contents("../config/web.php"));
            file_put_contents("../config/web.php",$strs);
            $this->redirect(array('/login/index'));
        }else{
            echo "<script>
                        if(alert('数据库账号或密码错误')){
                             location.href='index.php?r=install/two';
                        }else{
                             location.href='index.php?r=install/two';
                        }
            </script>";
        }
    }
}