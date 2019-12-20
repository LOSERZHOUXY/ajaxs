<?php
header('content-type:text/html;charset=utf-8');
$username = $_GET['user'];
$password = $_GET['pass'];

$users = array('徐丹','林智','王坤');

$passes = array('xd','lz','wk');


if( in_array( $username , $users ) && in_array( $password , $passes )){
	echo '欢迎登陆';
}else{
	echo '密码错误！';
}

?>