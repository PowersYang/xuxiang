<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎访问旭祥律师事务所</title>
<link href="css/css.css" rel="stylesheet" type="text/css">
</head>
<?php 
    include "top.php";
    require_once 'sqlHelp.php'; 
    $sqlHelper = new SqlHelper();
    
    //查找新闻 
    $sql1  =  "select * from news order by id desc limit 0,9";
    $res1 = mysql_query($sql1);
    while( $arr1 = mysql_fetch_assoc($res1) ){
        $row1[] = $arr1;
    }   
    
    //查找案例
    $sql2  =  "select * from anli order by id desc limit 0,9";
    $res2 = mysql_query($sql2);
    while( $arr2 = mysql_fetch_assoc($res2) ){
        $row2[] = $arr2;
    }
    
    //查找律师
    $sql3  =  "select * from lvshi";
    $res3 = mysql_query($sql3);
    while( $arr3 = mysql_fetch_assoc($res3) ){
        $row3[] = $arr3;
    }    
?>
<body>
<div class="banner">
<div class="container" id="idTransformView">
<ul class="slider" id="idSlider">
<li><img src="images/1.jpg" border="0"></li>
<li><img src="images/2.jpg" border="0"></li>
<li><img src="images/3.jpg" border="0"></li>
<li><img src="images/6.jpg" border="0"></li>
<li><img src="images/5.jpg" border="0"></li> 
</ul>
<ul class="num" id="idNum">
<li>1</li>
<li>2</li>
<li>3</li>
<li>4</li>
<li>5</li>
</ul>
</div>
</div>

<div id="center">
	<div id="centerL">
		<div class="title">
			<div class="title1">
				<div class="title_img"><img src="images/t2.svg" height="20" width="20"/></div> 
				<div class="title_text">律所简介</div>
			</div>
			<div class="more">
				<a href="firmIntroduction.php">...More</a>
			</div>
		</div>
		 <p align="left"  style="line-height:26px; background-color:#F2F2F2; margin:10px; color:#666666; border-top:10px; font-size:14px;">　　甘肃旭祥律师事务所
		          是由甘肃省司法厅批准设立的一家综合型合伙制律师事务所，所里由执业多年且在民事诉讼、行政诉讼、刑事辩护、金融投资、公司治理等法律服务领域富有经验的中青年律师组成。 经过多年的发展，现已形成一支业务能力强、实践经验丰富、
		          专业素质过硬、职业道德优良、能承办各类法律事务的律师队伍。旭祥人秉承“知行合一，天下为公”的执业理念；旭祥人奉行“法律至上<a href="firmIntroduction.php" style="text-decoration: none">【详情】</a></p>
	</div>
	<div id="centerC">
		   <div class="title">
			  <div class="title1">
				<div class="title_img"><img src="images/t2.svg" height="20" width="20"/></div> 
				<div class="title_text">经典案例</div>
			  </div>
			  <div class="more">
				   <a href="case.php?pageNow=1">...More</a>
			  </div>
			</div>
			<div id="anli">
				 <ul>
					<?php 				    
                         for($i=0; $i<count($row2); $i++){
                             $id = $row2[$i]['id'];
                             $time = substr( $row2[$i]['time'],0,11 );
                             if ($i==count($row2)-1){
                                 echo "<li style='border:none'><a href='shownews.php?id=$id'>";
                                 echo $row2[$i]['title'];
                                 echo "</a></li>";
                             }else{
                                 echo "<li><a href='showCase.php?id=$id'>";
                                 echo $row2[$i]['title'];
                                 echo "</a></li>";
                             }                          
                         }				    
				    ?>
				</ul>
			</div>
	</div>
	<div id="centerR">
		<div class="title">
			<div class="title1">
				<div class="title_img"><img src="images/t2.svg" height="20" width="20"/></div> 
				<div class="title_text">新闻动态</div>
			</div>
			<div class="more">
				<a href="firmNews.php?pageNow=1">...More</a>
			</div>
		</div>
		<div id="xinwen">
				<ul>
				    <?php 				    
                         for($i=0; $i<count($row1); $i++){
                             $id = $row1[$i]['id'];
                             $time = substr( $row1[$i]['time'],0,11 );
                             if ($i==count($row1)-1){
                                 
                                 //如果是页面最后一条显示的新闻  则不加下划线
                                 echo "<li style='border:none'><a href='shownews.php?id=$id'>";
                                 
                                 //如果新闻标题长度过长 则截取部分
                                 if( strlen($row1[$i]['title']) > 10 ){
                                     echo substr( $row1[$i]['title'],0,60 )."...";
                                 }else{
                                     echo $row1[$i]['title'];
                                 }
                                 echo "</a><span>".$time."</span></li>";
                             }else{
                                 echo "<li><a href='showNews.php?id=$id'>";
                                 if( strlen($row1[$i]['title']) > 10 ){
                                     echo substr( $row1[$i]['title'],0,60 )."...";
                                 }else{
                                     echo $row1[$i]['title'];
                                 }
                                 echo "</a><span>".$time."</span></li>";
                             }                          
                         }				    
				    ?>
          		</ul>		
		</div> 
	</div>
</div>
<div id="bottom2">
	<div id="login">
		<div class="title">
    		  <div class="title1">
        			<div class="title_img"><img src="images/t2.svg" height="20" width="20"/></div> 
        			<div class="title_text">管理员登录</div>
    		  </div>
		</div>
		<div class="table">
			<form action="doLogin.php" name="admin" method="post">
			<table id="loginTable" cellspacing="8">
			<tr>
				<td colspan="2">管理员：<input type="text" name="name" size="16" border="1"></td>
			</tr>
			<tr>
				<td colspan="2">密　码：<input type="password" name="password" size="16"></td>
			</tr>
			<tr>
			  <td colspan="2">验证码：<input type="text" name="verify" size="6"> <img align="absmiddle" width="60" height="25"src="getVerify.php"></td>
			
			</tr>
			<tr>
				<td align="center" width="110px"><input type="submit" value="确认登录"></td>
				<td align="center" width="110px"><input type="reset" value="重置"></td>
			</tr>
			</table>
		</form>
		</div>
	</div>
	<div id="lvshijieshao">
		<div class="title">
			<div class="title1">
				<div class="title_img"><img src="images/t2.svg" height="20" width="20"/></div> 
				<div class="title_text">律师风采</div>
			</div>
			<div class="more">
				<a href="lawyerIntroduction.php?pageNow=1">...More</a>
			</div>
		</div>
		<div class="img">
			<img height="180px" src="<?php echo $row3[0]['img']; ?>">
			<div class="lawyerName"> <?php echo $row3[0]['name']; ?> </div>
		</div>
		<div class="img">
			<img height="180px" src="<?php echo $row3[1]['img']; ?>">
			<div class="lawyerName"> <?php echo $row3[1]['name']; ?> </div>
		</div>
		<div class="img">
			<img height="180px" src="<?php echo $row3[2]['img']; ?>">
			<div class="lawyerName"> <?php echo $row3[2]['name']; ?> </div>
		</div>
		<div class="img">
			<img height="180px" src="<?php echo $row3[3]['img']; ?>">
			<div class="lawyerName"> <?php echo $row3[3]['name']; ?> </div>
		</div>
	</div>
</div>
<?php 
	include 'bottom.html';
	include 'js/lunbotu.js';
 ?>
</body>
</html>
