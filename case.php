<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>旭祥律师事务所</title>
</head>

<body>
<?php include 'top.php'; ?>
<link href="css/css1.css" rel="stylesheet" type="text/css">
<div id="content">
	<div id="contentL">	
		<?php 
		     include 'leftNav.php'; 
		     include 'sqlHelp.php';
		     $sqlHelper = new SqlHelper();
		      
		     //以下为分页代码
		     $sql1      = "select * from anli";
		     $res1      = mysql_query($sql1);
		     $count     = mysql_num_rows($res1);          //用于存放数据库中的总记录数
		     $pageSize  = 12;                           //定义每页显示的记录数
		     $totalPage = ceil($count/$pageSize);     //总页数
		     
		     if($_GET["pageNow"]){
		         $pageNow = $_GET["pageNow"];
		         if($pageNow > $totalPage){
		             $pageNow = $totalPage;
		         }
		     }else{
		         $pageNow = 1;
		     }
		      
		     $prePage  = $pageNow-1;
		     $nextPage = $pageNow+1;
		     $start    = ($pageNow - 1) * $pageSize;
		     
		     $sql2 =  "select * from anli order by id desc limit {$start},{$pageSize}";
		     $res2 = mysql_query($sql2);
		     while( $res = mysql_fetch_assoc($res2) ){
		         $row[] = $res;
		     }
		?>		
	</div>
	<div id="contentR">
		<div id="contentTile">
			网站首页 > 经典案例
		</div>
		<div id="text">
		    <div id="caseList">
		    <ul>
    			<?php 
                     for($i=0; $i<count($row); $i++){
                         $id = $row[$i]['id'];
                         $time = substr( $row[$i]['time'],0,11 );
                         if ($i==count($row)-1){
                             echo "<li style='border:none'><a href='showCase.php?id=$id'>";
                             echo $row[$i]['title'];
                             echo "</a><span>$time</span></li>";
                         }else{
                             echo "<li><a href='showCase.php?id=$id'>";
                             echo $row[$i]['title'];
                             echo "</a><span>$time</span></li>";
                         }                          
                      }
                 ?>	
             </ul>
             <div id="pageNav">
                <?php 
                      echo "总共{$count}条案例";
                      echo "<a href='case.php?pageNow=1'>&nbsp;首页&nbsp;</a>";
                      echo "<a href='case.php?pageNow=$prePage'>&nbsp;上一页&nbsp;</a>";
                      if( $pageNow < 5 && $pageNow > 0){
                          for($i=1; $i<=10; $i++){
                              echo "<a href='case.php?pageNow={$i}'>&nbsp;[$i]&nbsp;</a>";
                          }
                      }else{
                          if($pageNow+5 > $totalPage){
                              $n = $totalPage;
                          }else{
                              $n = $pageNow+5;
                          }
                           
                          for($i=$pageNow-4; $i <= $n; $i++ ){
                              echo "<a href='case.php?pageNow={$i}'>&nbsp;[$i]&nbsp;</a>";
                          }
                      }
                      echo "<a href='case.php?pageNow=$nextPage'>&nbsp;下一页&nbsp;</a>";
                      echo "<a href='case.php?pageNow=$totalPage'>&nbsp;尾页&nbsp;</a>";
                      echo "第[{$pageNow}]页/总共[{$totalPage}]页";
    			?>
    		</div>
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
