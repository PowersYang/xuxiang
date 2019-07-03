<ul class="nav">
   <li id="bottom_none"><a href="#"  onclick="DoMenu('ChildMenu1')">新闻管理</a>
      <ul id="ChildMenu1" class="collapsed">
         <li id="border_top"><a href="newsList.php?pageNow=1">新闻列表</a></li>
         <li><a href="sendNews.php">发布新闻</a></li>
      </ul>
   </li>
   <li id="bottom_none"><a href="#" onClick="DoMenu('ChildMenu2')">案例管理</a>
      <ul id="ChildMenu2" class="collapsed">
         <li id="border_top"><a href="caseList.php?pageNow=1">案例列表</a></li>
         <li><a href="addCase.php">添加案例</a></li>
      </ul>
   </li>
   <li id="bottom_none"><a href="#" onClick="DoMenu('ChildMenu3')">刑法管理</a>
      <ul id="ChildMenu3" class="collapsed">
         <li id="border_top"><a href="lawList.php?pageNow=1">法律列表</a></li>         
         <li><a href="addLaw.php">添加新法</a></li>
      </ul>
   </li>
   <li id="bottom_none"><a href="#" onClick="DoMenu('ChildMenu4')">律师管理</a>
      <ul id="ChildMenu4" class="collapsed">
         <li id="border_top"><a href="lawyerList.php?pageNow=1">律师列表</a></li>
         <li><a href="addLawyer.php">添加律师</a></li>
      </ul>
   </li>          
   <form id="form">
       <table text-align="center">
           <li id="bottom_none"><a href="update.php" onClick="DoMenu('ChildMenu3')">修改密码</a></li>     			     
               <?php
                   if(!$_SESSION['name']){
                       echo "<script> alert('请先登录！'); </script>";
                       echo "<script> window.location='index.php'; </script>";
                       unset($_SESSION['name']);
                   }
                   
   	  		       if($grade == 1)
    		          echo "<li id='bottom_none'><a href='admins.php' onClick='DoMenu('ChildMenu3')'>管理员列表</a>              			         
         	                </li>";
               ?>			     			    
	   </table>
   </form>
</ul>