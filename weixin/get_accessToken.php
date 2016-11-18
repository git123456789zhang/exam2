<?php
/**
 * Created by PhpStorm.
 * User: 张丹
 * Date: 2016/10/8
 * Time: 21:16
 */


//获取accessToken
function get_accessToken()
{
    $appId = "wx12f429ee39984ce9";
    $appSecret = "1ed809b628f7cf813fb05c7fff00f6d9";

    $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appId&secret=$appSecret";
    $file = file_get_contents($url);
    $arr = json_decode($file,true);
    $access_token = $arr['access_token'];
    return $access_token;
}

//定义curl的post提交方法
function curlPost($url,$data,$method){
    $ch = curl_init();   //1.初始化
    curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
    //4.参数如下
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

    if($method=="POST"){//5.post方式的时候添加数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $tmpInfo = curl_exec($ch);//6.执行

    if (curl_errno($ch)) {//7.如果出错
        return curl_error($ch);
    }
    curl_close($ch);//8.关闭
    return $tmpInfo;
}


//public function responseMsg()
//{
//    //get post data, May be due to the different environments
//    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
//
//    //extract post data
//    if (!empty($postStr)){
//        /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
//           the best way is to check the validity of xml by yourself */
//        libxml_disable_entity_loader(true);
//        $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
//        $fromUsername = $postObj->FromUserName;
//        $toUsername = $postObj->ToUserName;
//        $keyword = trim($postObj->Content);
//        $time = time();
//        $textTpl = "<xml>
//							<ToUserName><![CDATA[%s]]></ToUserName>
//							<FromUserName><![CDATA[%s]]></FromUserName>
//							<CreateTime>%s</CreateTime>
//							<MsgType><![CDATA[%s]]></MsgType>
//							<Content><![CDATA[%s]]></Content>
//							<FuncFlag>0</FuncFlag>
//							</xml>";
//        $imgTPI="<xml>
//						<ToUserName><![CDATA[%s]]></ToUserName>
//						<FromUserName><![CDATA[%s]]></FromUserName>
//						<CreateTime>%s</CreateTime>
//						<MsgType><![CDATA[%s]]></MsgType>
//						<MediaId><![CDATA[%s]]></MediaId>
//						</xml>";
//        if(!empty( $keyword ))
//        {
//            if($keyword=="你好"){
//
//                $msgType = "image";
//                $mediaid="";
//                $contentStr = "您好!";
//                $resultStr = sprintf($imgTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
//                echo $resultStr;
//            }else{
//                $msgType = "text";
//                $url="http://www.tuling123.com/openapi/api?key=ddfe877ab0e3ded0d61acabd5eca86ac&info=".$ketword;
//                $data=file_get_contents($url);
//                $arr=json_decode($data);
//                $contentStr = $arr->text;
//                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
//                echo $resultStr;
//            }
//
//        }else{
//            $msgType = "text";
//            $contentStr = "欢迎您的关注!";
//            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
//            echo $resultStr;
//        }
//
//    }else {
//        echo "";
//        exit;
//    }
//}
