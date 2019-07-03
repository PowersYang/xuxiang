<?php 

    require_once 'sqlHelp.php';
    session_start();
     
    $name     = $_POST['name'];
    $password = $_POST['password'];   
    $verify   = $_POST['verify'];
    $verify1  = $_SESSION['verify'];
    

    if($verify == $verify1){
        if($name == "" || $password == ""){
            echo "<script> alert('请输入用户名和密码！'); </script>";
            echo "<script> window.location='index.php'; </script>";
        }else{    
            $sqlHelper = new SqlHelper();
            $sql = "select * from admin where name = '{$name}'";
            $row = $sqlHelper->execute_dql2($sql);
            
            $grade = $row[0]['grade'];
            $_SESSION['grade']   = $grade;
            $_SESSION['adminId'] = $row[0]['id'];
            $_SESSION['name']    = $name;
            
            if ($name==$row[0]['name'] && $password==$row[0]['password']){
                header("Location:newsList.php?pageNow=1");
            }else{
                echo "<script> alert('请输入正确的用户名和密码！'); </script>";
                echo "<script> window.location='index.php'; </script>";
            } 
        }
    }else{
        echo "<script> alert('请输入验证码！'); </script>";
        echo "<script> window.location='index.php'; </script>";
    }
?>