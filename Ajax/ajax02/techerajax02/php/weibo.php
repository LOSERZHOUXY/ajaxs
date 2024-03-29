<?php
/*
**********************************************
	Author:	
	Date:	2019-12-7
	usage:
	
	api接口文档
	
	
			weibo.php?act=add&content=xxx	添加一条
				act : add 添加数据
				content ：数据内容
				
				返回：{error:0, id: 新添加内容的ID, time: 添加时间}
			
			
			weibo.php?act=get_page_count	获取页数
				返回：{count:页数}
			
			
			
			weibo.php?act=get&page=x		获取某一页数据
				返回：[{id: ID, content: "内容", time: 时间戳, acc: 顶次数, ref: 踩次数}, {...}, ...]
			
			
			
			weibo.php?act=acc&id=num			顶某一条数据
				返回：{error:0}
			
			weibo.php?act=ref&id=num			踩某一条数据
				返回：{error:0}
				
			weibo.php?act=del&id=num			删除某一条数据
				返回：{error:0}
	
	
	注意：	服务器所间戳都返回的时是秒（JS是毫秒）
**********************************************
*/

//创建数据库之类的
$db=@mysql_connect('localhost', 'root', '') or @mysql_connect('localhost', 'root', 'admin');

mysql_query("set names 'utf8'");
mysql_query('CREATE DATABASE pl_ajax');

mysql_select_db('pl_ajax');

$sql= <<< END
CREATE TABLE  `pl_ajax`.`weibo` (
`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`content` TEXT NOT NULL ,
`time` INT NOT NULL ,
`acc` INT NOT NULL ,
`ref` INT NOT NULL
) ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci
END;

mysql_query($sql);

//正式开始
//header('Content-type:pl/json');

$act=$_GET['act'];
$PAGE_SIZE=6;

switch($act)
{
	case 'add':
		$content=urldecode($_GET['content']);
		$time=time();
		
		$content=str_replace("\n", "", $content);
		
		$sql="INSERT INTO weibo (ID, content, time, acc, ref) VALUES(0, '{$content}', {$time}, 0, 0)";
		
		mysql_query($sql);
		
		$res=mysql_query('SELECT LAST_INSERT_ID()');
		
		$row=mysql_fetch_array($res);
		
		$id=(int)$row[0];
		
		echo "{\"error\": 0, \"id\": {$id}, \"time\": {$time}}";
		break;
	case 'get_page_count':
		$sql="SELECT COUNT(*)/{$PAGE_SIZE}+1 FROM weibo";
		
		mysql_query($sql);
		
		$res=mysql_query($sql);
		
		$row=mysql_fetch_array($res);
		
		$count=(int)$row[0];
		
		echo "{\"count\": {$count}}";
		break;
	case 'get':
		$page=(int)$_GET['page'];
		if($page<1)$page=1;
		
		$s=($page-1)*$PAGE_SIZE;
		
		$sql="SELECT ID, content, time, acc, ref FROM weibo ORDER BY time DESC LIMIT {$s}, {$PAGE_SIZE}";
		
		$res=mysql_query($sql);
		
		$aResult=array();
		while($row=mysql_fetch_array($res))
		{
			$arr=array();
			array_push($arr, 'id:'.$row[0]);
			array_push($arr, 'content:"'.$row[1].'"');
			array_push($arr, 'time:'.$row[2]);
			array_push($arr, 'acc:'.$row[3]);
			array_push($arr, 'ref:'.$row[4]);
			
			array_push($aResult, implode(',', $arr));
		}
		if(count($aResult)>0)
		{
			echo '[{'.implode('},{', $aResult).'}]';
		}
		else
		{
			echo '[]';
		}
		break;
	case 'acc':
		$id=(int)$_GET['id'];
		
		$res=mysql_query("SELECT acc FROM weibo WHERE ID={$id}");
		
		$row=mysql_fetch_array($res);
		
		$old=(int)$row[0]+1;
		
		$sql="UPDATE weibo SET acc={$old} WHERE ID={$id}";
		
		mysql_query($sql);
		
		echo '{error:0}';
		break;
	case 'ref':
		$id=(int)$_GET['id'];
		
		$res=mysql_query("SELECT ref FROM weibo WHERE ID={$id}");
		
		$row=mysql_fetch_array($res);
		
		$old=(int)$row[0]+1;
		
		$sql="UPDATE weibo SET ref={$old} WHERE ID={$id}";
		
		mysql_query($sql);
		
		echo '{error:0}';
		break;
	case 'del':
		$id=(int)$_GET['id'];
		
		$res=mysql_query("DELETE FROM weibo WHERE ID={$id}");
		
		if($res){
			echo '{error:0}';
		}else{
			echo '{error:1}';
		}
		break;
}
?>