<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>旭祥律师事务所后台管理</title>
<link href="ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="ueditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="ueditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="ueditor/umeditor.min.js"></script>
<script type="text/javascript" src="ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<?php
    include 'top.php';
    error_reporting(0);          //屏蔽错误
    $flag  = $_GET['flag'];
    $flag1 = $_POST['flag'];
    
    
    date_default_timezone_set("Asia/Shanghai"); 
    session_start();
    $grade     = $_SESSION['grade'];
    
    require_once 'sqlHelp.php';
    $sqlHelper = new SqlHelper();
    
    if( $flag1 == "add" ){
            //说明要添加律师
           $name     = $_POST['name'];
           $tel      = $_POST['tel'];
           $email    = $_POST['email'];
           $jianjie  = $_POST['jianjie'];
           $time     = date('Y/m/d H:i:s',time());      
           
           //以下为上传照片
           $uploaddir = "./photos/";                                 //设置文件保存目录 注意包含/  
           $type      = array("jpg","gif","jpeg","png");             //设置允许上传文件的类型
           $patch     = "http://localhost/xuxiang/";     //程序所在路径
                 //$patch="http://127.0.0.1/cr_downloadphp/upload/files/";//程序所在路径
          
           //获取文件后缀名函数
              function fileext($filename){
                        return substr(strrchr($filename, '.'), 1);
                    }
            
           //生成随机文件名函数  
            function random($length){
                $hash  = 'CR-';
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
                $max   = strlen($chars) - 1;
                mt_srand((double)microtime() * 1000000);
                    for($i = 0; $i < $length; $i++)
                    {
                        $hash .= $chars[mt_rand(0, $max)];
                    }
                return $hash;
            }
           
           $a = strtolower(fileext($_FILES['photo']['name']));
           //判断文件类型
           if(!in_array($a,$type))
             {
                $text = implode(",",$type);
                echo "您只能上传以下类型文件: ",$text,"<br>";
             }
           //生成目标文件的文件名  
           else{
            $filename = explode(".",$_FILES['photo']['name']);
                do{
                    $filename[0] = random(10); //设置随机数长度
                    $name1 = implode(".",$filename);
                    
                    $uploadfile = $uploaddir.$name1;
                }while(file_exists($uploadfile));
           
                if (is_uploaded_file($_FILES['photo']['tmp_name'])){
                    
                    $sql = "insert into lvshi (name,tel,email,jianjie,time,img) value ('$name','$tel','$email','$jianjie','$time','$uploadfile')";
                    $res = $sqlHelper->execute_dml($sql);
                    
                    if( move_uploaded_file($_FILES['photo']['tmp_name'],$uploadfile) && $res==1 ){
         
                        echo "<script> alert('添加成功！'); </script>";
                        echo "<script> window.location='lawyerList.php?pageNow=1'; </script>";
                      }
                      else{
                        echo "上传照片失败！";
                      }
                }
           }
    }elseif($flag == "del"){
        $id  = $_GET['id'];
        $sql = "delete from lvshi where id = $id";
        $res = $sqlHelper->execute_dml($sql);
        if( $res==1 ){
            //说明删除成功
            echo "<script> alert('删除成功！'); </script>";
            echo "<script> window.location='lawyerList.php?pageNow=1'; </script>";
        }
    }elseif( $flag == "update" ){
        //说明要修改律师信息
        $id  = $_GET['id'];
        $sql = "select * from lvshi where id = $id";
        $res = $sqlHelper->execute_dql($sql);
        while($res1 = mysql_fetch_assoc($res)){
            $row[] = $res1;
        }
?>
    <html>
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
            		后台管理 > 修改律师信息
            	</div>
            	<div id="text" align="center">
           			<form action='lawyerService.php' method="post" enctype="multipart/form-data">
                        <table align="center" width="800px">
              			     <tr><td>名称：</td> <td width="100"><input type="text" name="name" value="<?php echo $row[0]['name']; ?>"></td>　<td rowspan="2" rolspan="3" align="center"><img height="200" src="<?php echo $row[0]['img']; ?>"></td><td width="80"></td></tr>
              			     <tr><td>电话：</td> <td><input type="text" name="tel" value="<?php echo $row[0]['tel']; ?>"></td></tr>
               			     <tr><td>邮箱：</td> <td><input type="text" name="email" value="<?php echo $row[0]['email']; ?>"></td> <td align="center" colspan="2"><input type="file" name="photo" /></td></tr>
               			    
               			     
                    		 <tr><td>简介：</td> <td colspan="4">
                    		                      <script type="text/plain" id="myEditor" name="jianjie" style="width:680px;"><?php echo $row[0]['jianjie']; ?></script>
                    		                   </td>
                    		 </tr>	  		   	                             
                             
                             <tr><td> <input type="hidden" name="id" value="<?php echo $id; ?>"> </td></tr> 
                             <input type="hidden" name="flag" value="updateProcess"></input>
               			     <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                             <tr align="center"><td colspan="4"><input type="submit" value="确认修改">　　　<input type="reset" value="重置"></td></tr>    
               			     <input type="hidden" name="time" value=" <?php
                	  		   	               date_default_timezone_set("Asia/Shanghai");
                                               echo $time = date('Y/m/d H:i:s',time()); ?>">            
               			</table>
                    </form>        			
           		</div>
           	  </div>
         </div>
    </body>
    </html>        
<?php
    }  
    
    if( $flag1 == "updateProcess" ){
        
        //更新律师信息过程
        $name    = $_POST['name'];
        $tel     = $_POST['tel'];
        $email   = $_POST['email'];
        $jianjie = $_POST['jianjie'];
        $time    = $_POST['time'];
        $id      = $_POST['id'];

        //以下为上传照片
        $uploaddir = "./photos/";                                 //设置文件保存目录 注意包含/
        $type      = array("jpg","gif","jpeg","png");             //设置允许上传文件的类型
        $patch     = "http://localhost/xuxiang/";     //程序所在路径
        //$patch="http://127.0.0.1/cr_downloadphp/upload/files/";//程序所在路径
        
        //获取文件后缀名函数
        function fileext($filename){
            return substr(strrchr($filename, '.'), 1);
        }
        
        //生成随机文件名函数
        function random($length){
            $hash  = 'CR-';
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz';
            $max   = strlen($chars) - 1;
            mt_srand((double)microtime() * 1000000);
            for($i = 0; $i < $length; $i++)
            {
                $hash .= $chars[mt_rand(0, $max)];
            }
            return $hash;
        }
        
        $a = strtolower(fileext($_FILES['photo']['name']));
        
          //如果照片被修改了
            if(in_array($a,$type)){
                //如果照片格式符合
                $filename = explode(".",$_FILES['photo']['name']);
                do{
                    $filename[0] = random(10); //设置随机数长度
                    $name1 = implode(".",$filename);
                
                    $uploadfile = $uploaddir.$name1;
                }while(file_exists($uploadfile));
                 
                if (is_uploaded_file($_FILES['photo']['tmp_name'])){
                
                    $sql = "update lvshi set name='$name', tel='$tel', email='$email', jianjie='$jianjie',time='$time',img='$uploadfile'  where id=$id";
                    $res = $sqlHelper->execute_dml($sql);
                
                    if( move_uploaded_file($_FILES['photo']['tmp_name'],$uploadfile) && $res==1 ){
                         
                        echo "<script> alert('修改成功！'); </script>";
                        echo "<script> window.location='lawyerList.php?pageNow=1'; </script>";
                    }
                    else{
                        echo "上传照片失败！";
                    }
                }
            }else{
                //照片格式不符合
                echo "<script> alert('您上传的照片格式不正确！'); </script>";
                echo "<script> window.location='lawyerList.php?pageNow=1'; </script>";
            }
            
            //如果没有上传照片
            if($_FILES['photo']['name']==''){
                
                $sql = "update lvshi set name='$name', tel='$tel', email='$email', jianjie='$jianjie',time='$time' where id=$id";
                $res = $sqlHelper->execute_dml($sql);
                
                if( $res==1 ){                   
                    echo "<script> alert('修改成功！'); </script>";
                    echo "<script> window.location='lawyerList.php?pageNow=1'; </script>";
                }
                else{
                    echo "上传照片失败！";
                }
            }
               
    }
    include 'bottom.html';
    include 'js/menu.js';
?>
<script type="text/javascript">
    //实例化编辑器
    var um = UM.getEditor('myEditor');
    um.addListener('blur',function(){
        $('#focush2').html('编辑器失去焦点了')
    });
    um.addListener('focus',function(){
        $('#focush2').html('')
    });
    //按钮的操作
    function insertHtml() {
        var value = prompt('插入html代码', '');
        um.execCommand('insertHtml', value)
    }
    function isFocus(){
        alert(um.isFocus())
    }
    function doBlur(){
        um.blur()
    }
    function createEditor() {
        enableBtn();
        um = UM.getEditor('myEditor');
    }
    function getAllHtml() {
        alert(UM.getEditor('myEditor').getAllHtml())
    }
    function getContent() {
        var arr = [];
        arr.push("使用editor.getContent()方法可以获得编辑器的内容");
        arr.push("内容为：");
        arr.push(UM.getEditor('myEditor').getContent());
        alert(arr.join("\n"));
    }
    function getPlainTxt() {
        var arr = [];
        arr.push("使用editor.getPlainTxt()方法可以获得编辑器的带格式的纯文本内容");
        arr.push("内容为：");
        arr.push(UM.getEditor('myEditor').getPlainTxt());
        alert(arr.join('\n'))
    }
    function setContent(isAppendTo) {
        var arr = [];
        arr.push("使用editor.setContent('欢迎使用umeditor')方法可以设置编辑器的内容");
        UM.getEditor('myEditor').setContent('欢迎使用umeditor', isAppendTo);
        alert(arr.join("\n"));
    }
    function setDisabled() {
        UM.getEditor('myEditor').setDisabled('fullscreen');
        disableBtn("enable");
    }

    function setEnabled() {
        UM.getEditor('myEditor').setEnabled();
        enableBtn();
    }

    function getText() {
        //当你点击按钮时编辑区域已经失去了焦点，如果直接用getText将不会得到内容，所以要在选回来，然后取得内容
        var range = UM.getEditor('myEditor').selection.getRange();
        range.select();
        var txt = UM.getEditor('myEditor').selection.getText();
        alert(txt)
    }

    function getContentTxt() {
        var arr = [];
        arr.push("使用editor.getContentTxt()方法可以获得编辑器的纯文本内容");
        arr.push("编辑器的纯文本内容为：");
        arr.push(UM.getEditor('myEditor').getContentTxt());
        alert(arr.join("\n"));
    }
    function hasContent() {
        var arr = [];
        arr.push("使用editor.hasContents()方法判断编辑器里是否有内容");
        arr.push("判断结果为：");
        arr.push(UM.getEditor('myEditor').hasContents());
        alert(arr.join("\n"));
    }
    function setFocus() {
        UM.getEditor('myEditor').focus();
    }
    function deleteEditor() {
        disableBtn();
        UM.getEditor('myEditor').destroy();
    }
    function disableBtn(str) {
        var div = document.getElementById('btns');
        var btns = domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            if (btn.id == str) {
                domUtils.removeAttributes(btn, ["disabled"]);
            } else {
                btn.setAttribute("disabled", "true");
            }
        }
    }
    function enableBtn() {
        var div = document.getElementById('btns');
        var btns = domUtils.getElementsByTagName(div, "button");
        for (var i = 0, btn; btn = btns[i++];) {
            domUtils.removeAttributes(btn, ["disabled"]);
        }
    }
</script>