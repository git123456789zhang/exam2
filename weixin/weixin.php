<?php
/**
 * Created by PhpStorm.
 * User: 张丹
 * Date: 2016/11/4
 * Time: 14:27
 */
include("get_accessToken.php");
//调用获取accessToken方法的类
$access_token = get_accessToken();


//调用自定义菜单接口
$menuUrl = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
$data= '{
     "button":[
     {
          "type":"view",
          "name":"我的作业",
          "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx12f429ee39984ce9&redirect_uri=http%3a%2f%2ftjgbank.cn%2fzhangdan%2findex.php&response_type=code&scope=snsapi_userinfo&state=123#wechat_redirect";
      },
      {
           "name":"菜单",
           "sub_button":[
           {
               "type":"view",
               "name":"我的项目",
               "url":"https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appId&redirect_uri=$user_url&response_type=code&scope=snsapi_userinfo&state=state=STATE#wechat_redirect"
            },
            {
               "type":"view",
               "name":"视频",
               "url":"http://v.qq.com/"
            },
            {
               "type":"click",
               "name":"赞一下我们",
               "key":"V1001_GOOD"
            }]
       }]
 }';

$method="POST";
$file=curlPost($menuUrl,$data,$method);
//echo $file;

//用户同意网页授权



