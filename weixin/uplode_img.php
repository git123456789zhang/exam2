<?php
/**
 * Created by PhpStorm.
 * User: 张丹
 * Date: 2016/11/6
 * Time: 11:53
 */
include("get_accessToken.php");
//调用获取accessToken方法的类
$access_token = get_accessToken();
//echo $access_token;die;
$url="https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$access_token."&type00=img";
$data = array('media'=>'@1.bmp');
$method ="POST";
$img = curlPost($url,$data,$method);
echo $img;