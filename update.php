<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发布新闻</title>
</head>

<?php
	include 'top.php';
	session_start();
	$grade = $_SESSION['grade'];
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
			后台管理 > 修改资料
		</div>
		<div id="text" align="left">
			<div  id="updatePassword">
			<form action="updateProcess.php" method="post">
			     <table border='0' width="400px">
    			     <tr><td>原密码：</td> <td align="left"><input type="password" name="jiumima"></input></td><td align="left" style="font-size:12px">*请输入原来的密码</td></tr>
    			     <tr><td>新密码：</td>  <td align="left"><input type="password" name="xinmima1"></input></td><td align="left" style="font-size:12px">*请输入新密码</td></tr>
    			     <tr><td>确认密码：</td> <td align="left"><input type="password" name="xinmima2"></input></td><td align="left" style="font-size:12px">*请再次输入新密码</td></tr>
    			     <tr align="center"><td colspan="2"><input type="submit" value="确认修改"></input>　　　<input type="reset" value="重置"></input></td></tr>
			     </table>
			</form>
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
