<?php
/**
 * Created by PhpStorm.
 * User: 张丹
 * Date: 2016/11/4
 * Time: 19:45
 */
$appId = "wx12f429ee39984ce9";
$appSecret = "1ed809b628f7cf813fb05c7fff00f6d9";
$user_url = "http%3a%2f%2ftjgbank.cn%2fzhangdan%2findex.php";

$power_code = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$appId."&redirect_uri=".$user_url."&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
$file = file_get_contents($power_code);
$arr = json_decode($file,true);
print_r($power_code);