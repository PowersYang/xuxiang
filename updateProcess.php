<?php
	require_once 'sqlHelp.php';
	session_start();
	
	$id       = $_SESSION['adminId'];      //接受传过来的管理员id
	$jiumima  = $_POST['jiumima'];
	$xinmima1 = $_POST['xinmima1'];
	$xinmima2 = $_POST['xinmima2'];
	
	$sqlHelper = new SqlHelper();
	
	$sql = "select * from admin where id = $id";
	$res1 = mysql_query($sql);
	while( $res = mysql_fetch_assoc($res1) ){
	    $row[] = $res;
	}	

	if( $jiumima == '' ){
	    echo "<script> alert('请输入原来的密码密码！'); </script>";
	    echo "<script> window.location='update.php'; </script>";
	}
	
	if( $xinmima1 != $xinmima2 ){
	    echo "<script> alert('两次输入的新密码不相同，请重新输入！'); </script>";
	    echo "<script> window.location='update.php'; </script>";
	}
	
	if( $xinmima1=='' || $xinmima2=='' ){
	    echo "<script> alert('新密码不能为空！'); </script>";
	    echo "<script> window.location='update.php'; </script>";
	}
	
	if( $jiumima == $row[0]['password'] && $xinmima1 != '' && $xinmima2 != ''){
	    //如果符合修改密码的条件
	    $sql2 = "update admin set password = '$xinmima1' where id = '$id'";
	    $res2 = $sqlHelper->execute_dml($sql2);
	    if( $res2 == 1 ){
	        echo "<script> alert('密码修改成功！'); </script>";
	        echo "<script> window.location='newsList.php?pageNow=1'; </script>";
	    }
	}else{
    	    echo "<script> alert('您输入的旧密码不正确，请重新输入！'); </script>";
    	    echo "<script> window.location='update.php'; </script>";
	}
?>

