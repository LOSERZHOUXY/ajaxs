<?php
header('content-type:text/html;charset=utf-8');

$username = $_GET['user'];

$users = array('甘云飞','陈泽金','王璐莹');

if( in_array( $username , $users ) ){	
	echo '{"code": 1, "msg": "用户名已经被注册了！"}';
	//echo "{'code': 1, 'msg': '用户名已经被注册了！'}";
}else{
	echo '{"code": 0, "msg": "用户名可以注册！"}';
}

?>