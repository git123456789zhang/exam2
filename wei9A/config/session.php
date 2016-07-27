<?php
	// 为配置选项设置值
	ini_set("session.save_handler","user");
	//session.gc_probability = 1 分子
	ini_set("session.gc_probability",1);
	//session.gc_divisor = 1000 分母
	ini_set("session.gc_divisor", 1000);
	//session.gc_maxlifetime = 1440 垃圾回收时间，session有效期

	// 集用户级会话存储功能
	session_set_save_handler( "open","close","read","write","destroy","gc" );

	// 连接数据库
	function open()
	{
	    @$link = mysql_connect('127.0.0.1', 'root', 'root');
	    mysql_query('set names utf8');
	    mysql_query('use yii');
	}

	// 关闭数据库
	function close()
	{
	    mysql_close();
	}

	// 读取数据信息
	function read($sess_id)
	{
	    $sql = "select session_data from `session` where session_id = '$sess_id'";
	    $result = mysql_query($sql);
	    if($rows = mysql_fetch_assoc($result)){
	        return $rows['session_data']; }else{
	        return '';
	    }
	}

	// 写入数据
	function write($sess_id,$sess_data)
	{ 
	    // 用replace语法解决插入新纪录，存在就更新
	    $time = date('Y-m-d H:i:s', time());
	    $sql = "replace into session(session_id,session_data,session_time) values('".$sess_id."','".$sess_data."','".$time."')";
	    if(!mysql_query($sql)){
	        echo mysql_error();
	    }else{
	        return true;
	    }
	}

	// 删除数据
	function destroy($sess_id)
	{
	    echo __FUNCTION__;
	    $sql = "delete from `session` where session_id = '$sess_id'";
	    return mysql_query($sql);
	}

	// 删除过期的所有session
	function gc($sess_id)
	{
	    echo __FUNCTION__;
	    $sql = "delete from `session` where now()-session_time > '1440' ";
	    return mysql_query($sql);
	}

	header("content-type:text/html;charset=utf8");
	session_start();
	$_SESSION['name']='lisi';
	echo session_id().'<br>';
	echo $_SESSION['name'].'<br>';

	//$new = serialize('username|s:8:"zhangsan";name|s:8:"zhangdan";');
	//print_r($new);echo "<br />";
?>