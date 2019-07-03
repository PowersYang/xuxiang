<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>律师介绍</title>
</head>
<?php 
    include 'top.php';
    require_once 'sqlHelp.php';
    $sqlHelper = new SqlHelper();
    $id = $_GET['id'];
    
    $sql = "select * from lvshi where id = $id";
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
			网站首页 > 律师介绍
		</div>
		<div id="text">
    		 <table align="center" width="700px" border="0">
                    <tr><td align="right">姓名：</td><td><?php echo $row[0]['name']; ?></td> 
                        <td rowspan="3" rolspan="3" align="center"><img height="200" src="<?php echo $row[0]['img']; ?>"></td>
                        <td width="100"></td>
                    </tr>
             	    <tr><td align="right">电话：</td><td><?php echo $row[0]['tel']; ?></td> </tr>
               	    <tr><td align="right">邮箱：</td><td><?php echo $row[0]['email']; ?></td> </tr>             			     
                    <tr height="60"><td align="right">简介：</td> <td colspan="3">
                                         <?php echo $row[0]['jianjie']; ?>
                                      </td>
                    </tr>	  		   	                                      
                              
                                     
              </table>   
		</div>
	</div>
</div>
</body>
</html>
<?php
	include 'bottom.html';
	include 'js/menu.js';
?>