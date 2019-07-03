<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改案例</title>
<link href="ueditor/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="ueditor/third-party/jquery.min.js"></script>
<script type="text/javascript" charset="utf-8" src="ueditor/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="ueditor/umeditor.min.js"></script>
<script type="text/javascript" src="ueditor/lang/zh-cn/zh-cn.js"></script>
</head>
<?php 
    include 'top.php';
    require_once 'sqlHelp.php';
    error_reporting(0);
    session_start();
    
    $sqlHelper = new SqlHelper();
    $flag  = $_GET['flag'];
    $flag1 = $_POST['flag'];
    $grade = $_SESSION['grade'];
        
    if($flag == "del"){
        //说明要删除法律
        $id  = $_GET['id'];
        $sql = "delete from law where id = $id";
        $res = $sqlHelper->execute_dml($sql);
        if( $res==1 ){
            //说明删除成功
            echo "<script> alert('删除成功！'); </script>";
            echo "<script> window.location='lawList.php?pageNow=1'; </script>";
        }
    }elseif ( $flag1 == "add" ){
        //说明要添加法律
        date_default_timezone_set("Asia/Shanghai");
        $title  = $_POST['title'];
        $zuozhe = $_POST['zuozhe'];
        $text   = $_POST['text'];
        $type   = $_POST['type'];
        $time   = date('Y/m/d H:i:s',time());
        
        $sql = "insert into law (title,zuozhe,text,time,type) value ('$title','$zuozhe','$text','$time','$type')";
        $res = $sqlHelper->execute_dql($sql);
        
        if ($res){
            echo "<script> alert('添加成功！'); </script>";
            echo "<script> window.location='lawList.php?pageNow=1'; </script>";
        }
    }elseif( $flag == "update" ){
        //说明要更新法律
        $id  = $_GET['id'];
        $sql = "select * from law where id = $id";
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
            		后台管理 > 修改法律
            	</div>
            	<div id="text" align="center">
           			<form action='lawService.php' method="post">
                         <table align="center" width="800px">
              			     <tr><td>法律标题：</td> <td><input type="text" name="title" size="50" value="<?php echo $row[0]['title']; ?>"></td></tr>
               			     <tr><td>修改者：</td>  <td><?php echo $_SESSION['name']; ?></td><input type="hidden" name="zuozhe" value="<?php echo $_SESSION['name']; ?>"></tr>
                    		 <tr><td>法律类型：</td> <td> <select name="type">
        					 								<option value="xingshi">刑事</option>
        													<option value="minshi">民事</option>
        													<option value="xingzheng">行政</option>
        													<option value="zonghe">综合</option>
					 							       </select> 
					 							  </td>
					 		 </tr>
                    		 <tr><td>法律内容：</td> <td>
                    		             <script type="text/plain" id="myEditor" name="text" style="width:680px;height:230px;"><?php echo $row[0]['text']; ?></script></td>
                    		 </tr>	  		   	
                             <tr>
                                 <td> <input type="hidden" name="time" value=" <?php
                	  		   	               date_default_timezone_set("Asia/Shanghai");
                                               echo $time = date('Y/m/d H:i:s',time()); ?>"> 
                                 </td>
                             </tr>
                             <tr><td> <input type="hidden" name="id" value="<?php echo $id; ?>"> </td></tr> 
                            <tr align="center"><td colspan=2><input type="submit" value="确认修改">　　　<input type="reset" value="重置"></td></tr>    
               			    <input type="hidden" name="flag" value="updateProcess"></input>
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
        $title  = $_POST['title'];
        $zuozhe = $_POST['zuozhe'];
        $text   = $_POST['text'];
        $time   = $_POST['time'];
        $type   = $_POST['type'];
        $id     = $_POST['id'];
        
        $sql = "update law set title='$title', zuozhe='$zuozhe', text='$text', time='$time', type='$type' where id=$id";
        $res = $sqlHelper->execute_dml($sql);
        if( $res==1 ){
            //说明修改成功
            echo "<script> alert('修改成功！'); </script>";
            echo "<script> window.location='lawList.php?pageNow=1'; </script>";
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