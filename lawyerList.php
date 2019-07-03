<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>律师列表</title>
</head>
<?php 
    include 'top.php'; 
    session_start();
    $grade = $_SESSION['grade'];
    $id    = $_SESSION['adminId'];
?>

<body>
<link href="css/css1.css" rel="stylesheet" type="text/css">
<div id="content">
	<div id="contentL">
		<div class="left_2">
		   <?php include 'adminMenu.php'; ?>
		</div>
	</div>
	
    	<?php
            require_once 'sqlHelp.php';       
        	$sqlHelper = new SqlHelper();
        	
        	//以下为分页代码
            $sql1      = "select * from lvshi";    
            $res1      = mysql_query($sql1);
            $count     = mysql_num_rows($res1);          //用于存放数据库中的总记录数    
            $pageSize  = 10;                           //定义每页显示的记录数     
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
            
            $sql2 =  "select * from lvshi order by id desc limit {$start},{$pageSize}";
            $res2 = mysql_query($sql2);
            while( $res = mysql_fetch_assoc($res2) ){
                $row[] = $res;
            }
        ?>
    	
	<div id="contentR">
		<div id="contentTile">
			后台管理 > 律师列表
		</div>
		<div id="text" align="center">
			<table class="listTable" width="750px" cellpadding="0" cellspacing="0">
				<tr> <td width="40">序号</td> <td width="100">名称</td> <td width="150">电话</td> <td width="150">邮箱</td> <td>添加时间</td> <td colspan="2">操作</td> </tr>
				<?php
					$rows = count($row);
					for( $i=0; $i<$rows; $i++){
					    $xuhao = ($pageNow-1)*$pageSize + $i + 1;
						echo "<tr>
								<td>{$xuhao}</td> 
								<td><a href='showLawyer.php?id={$row[$i]['id']}'>{$row[$i]['name']}</a></td>
								<td>{$row[$i]['tel']}</td>
								<td>{$row[$i]['email']}</td>
								<td>{$row[$i]['time']}</td>
								<td><a href='lawyerService.php?flag=del&&id={$row[$i]['id']}'>删除</a></td> 
								<td><a href='lawyerService.php?flag=update&&id={$row[$i]['id']}'>修改</a></td>
							</tr>";
					}
				?>
			</table>
			<div class="fenye">
			    <?php 
			          echo "共{$count}位律师";
			          echo "<a href='lawyerList.php?pageNow=1'> 首页 </a>";
			          echo "<a href='lawyerList.php?pageNow=$prePage'> 上一页 </a>";  
    			      if( $pageNow < 5 && $pageNow > 0){    
    			          for($i=1; $i<=10; $i++){
    			              echo "<a href='lawyerList.php?pageNow={$i}'> [$i] </a>";
    			          }
    			      }else{
    			          if($pageNow+5 > $totalPage){
    			              $n = $totalPage;
    			          }else{
    			              $n = $pageNow+5;
    			          }   
    			          
        			          for($i=$pageNow-4; $i <= $n; $i++ ){
        			              echo "<a href='lawyerList.php?pageNow={$i}'> [$i] </a>";
        			          }
    			      }
			          echo "<a href='lawyerList.php?pageNow=$nextPage'> 下一页 </a>";
			          echo "<a href='lawyerList.php?pageNow=$totalPage'> 尾页 </a>";
			          echo "当前是[{$pageNow}]页/总共[{$totalPage}]页";
			    ?>
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
