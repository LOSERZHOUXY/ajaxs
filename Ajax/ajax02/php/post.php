<?php
header('content-type:text/html;charset=utf-8');
$username = $_POST['user'];
$users = array('杨蓝','吴玮','张李春');
if( in_array( $username , $users ) ){	
	echo '用户名已经被注册了！';
}else{
	echo '可以注册';
}

?>