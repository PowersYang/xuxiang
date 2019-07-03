<?php 
    require_once 'sqlHelp.php';
    $sqlHelper = new SqlHelper();
    $flag      = $_GET['flag'];
    
    if($flag == "add"){
        //说明要添加管理员
        $name     = $_GET['name'];
        $password = $_GET['password'];
        
        if( $name=='' || $password=='' ){
            echo "<script> alert('请输入名称和密码！'); </script>";
            echo "<script> window.location='addAdmin.php'; </script>";
        }
        
        if( $name!=='' && $password!=='' ){
            
            //检查数据库中是否已经存在该管理员
            $sql1 = "select * from admin";
            $res1 = $sqlHelper->execute_dql($sql1);
            while( $arr = mysql_fetch_assoc($res1) ){
                $row[] = $arr;
            }
            $flag1 = true;
            
            for($i=0; $i<count($row); $i++){
                if( $name==$row[$i]['name'] ){
                    echo "<script> alert('该管理员已存在！'); </script>";
                    echo "<script> window.location='addAdmin.php'; </script>";
                    $flag1 = false;
                }
            }
            
            if( $flag1==true ){
                //符合添加条件  添加管理员
                $sql2 = "insert into admin (name, password) values ('$name', '$password')";
                $res2 = $sqlHelper->execute_dml($sql2);
                if( $res2==1 ){
                    //说明添加成功
                    echo "<script> alert('添加成功！'); </script>";
                    echo "<script> window.location='admins.php'; </script>";
                }
            }
        }
    }elseif( $flag=='del' ){
        //说明要删除管理员
        $id  = $_GET['id'];
        if($id==1){
            echo "<script> alert('不能删除超级管理员！'); </script>";
            echo "<script> window.location='admins.php?pageNow=1'; </script>";
        }else{
            $sql = "delete from admin where id = $id";
            $res = $sqlHelper->execute_dml($sql);
            if( $res==1 ){
                //说明删除成功
                echo "<script> alert('删除成功！'); </script>";
                echo "<script> window.location='admins.php?pageNow=1'; </script>";
            }
        }
    }
?>