<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新闻详情</title>
</head>
<?php 
    include 'top.php';
    require_once 'sqlHelp.php';
    $sqlHelper = new SqlHelper();
    $id = $_GET['id'];
    
    $sql = "select * from law where id = $id";
    $res = $sqlHelper->execute_dql($sql);
    while($res1 = mysql_fetch_assoc($res)){
        $row[] = $res1;
    }
?>


<body>
<link href="css/css1.css" rel="stylesheet" type="text/css">
<div id="content">
	<div id="contentL">
		<?php include 'leftNav.php'; ?>
	</div>
	<div id="contentR">
		<div id="contentTile">
			网站首页 > 法律详情
		</div>
		<div id="text">
    		  
        			<h2><center> <?php echo $row[0]['title']; ?> </center></h2>
        			<h5><center> <?php echo $row[0]['zuozhe']."　　发布于：".$row[0]['time']; ?> </center></h5>
        			 <?php echo $row[0]['text']; ?> 
    		  
		</div>
	</div>
</div>
</body>
</html>
<?php
	include 'bottom.html';
	include 'js/menu.js';
?>