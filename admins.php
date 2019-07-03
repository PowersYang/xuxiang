<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>旭祥律师事务所后台管理</title>
</head>

<?php
	include 'top.php';
	require_once 'sqlHelp.php';
	session_start();
	$grade = $_SESSION['grade'];
	
	$sqlHelper = new SqlHelper();
	$sql = "select * from admin";
	$res = mysql_query($sql);
	while( $res1=mysql_fetch_assoc($res) ){
	    $row[] = $res1;
	}
?>

<body>
<link href="css/css1.css" rel="stylesheet" type="text/css">
<div id="content">
	<div id="contentL">
		<div class="left_2">
               <?php include 'adminMenu.php'; ?>
		</div>
	</div>
	<div id="contentR">
		<div id="contentTile">
			后台管理 > 管理员列表
		</div>
		<div id="text">
		  <div id="adminTable">
			<table width="500" border='1' cellspacing="0" cellpadding="0">
			     <tr><td>序号</td><td>名称</td><td>级别</td><td>删除</td></tr>
			   <?php
			       for($i=0; $i<count($row); $i++){ 
			          $num = $i+1;
			          echo "<tr><td>". $num ."</td><td>". $row[$i]['name'] ."</td><td>". $row[$i]['grade'] ."</td><td><a href='adminsService.php?flag=del&&id={$row[$i]['id']}'>删除</a></td></tr>";
			       }
			    ?>
			</table>
			<a href="addAdmin.php">添加管理员</a>
			<h5>提示：级别为1的是超级管理员，级别为0的是普通管理员！</h5>
			</div>
		</div>
	</div>
</div>
</body>
</html>

<?php
	include 'bottom.html';
	include 'js/menu.js';
?>
