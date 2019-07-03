<?php 
	class SqlHelper{
	    
	    public $conn;
	    public $dbname   = "xuxiang";
	    public $username = "root";
	    public $password = "";
	    public $host     = "localhost";
	    
	    //用于链接数据库
	    public function __construct(){
	        $this->conn = mysql_connect($this->host, $this->username, $this->password);
	        if (!$this->conn) {
	            die("连接数据库失败".mysql_error());
	        }
	        
	        mysql_select_db($this->dbname, $this->conn);
	    }
	    
	    //用于执行sql语句
	    public function execute_dql($sql){
	        $res = mysql_query($sql, $this->conn) or die(mysql_error);
	        return $res;
	    }
	    
	    public function execute_dml($sql){
	    
	        $b=mysql_query($sql,$this->conn) or die(mysql_error());
	        if (!$b){
	            return 0;
	        }else {
	            if (mysql_affected_rows($this->conn) > 0){
	                return 1; 
	            }else {
	                return 2;  
	            }
	        }
	    }
	    
	    public function execute_dql2($sql){
	    
	        $arr=array();
	        $res=mysql_query($sql,$this->conn) or die(mysql_error());
	        $i=0;
	    
	        //将查询结果集存到$arr数组中
	        while ($row=mysql_fetch_assoc($res)){
	            $arr[$i++]=$row;
	        }
	        mysql_free_result($res);
	        return $arr;
	    }
	    
	    //$sql1类似于  "select * from admin"
	    //$sql2类似于  "select * from users limit {$start},{$pageSize}"
	    public function fenye($sql1,$sql2){
	        
	        $res1 = mysql_query($sql1);
	        $count = mysql_num_rows($res1);          //用于存放数据库中的总记录数
	        
	        $pageSize = 2;                           //定义每页显示的记录数
	      
	        $totalPage = ceil($count/$pageSize);     //总页数
	        
	        
	        if($_GET["page"]){                
	            $page = $_GET["page"];
	            if($page > $totalPage){
	                $page = $totalPage;
	            }
	        }else{
	            $page = 1;   
	        }
	        
	        $start = ($page-1)*$pageSize;
	        
	        $res2 = mysql_query($sql2);
	        while( $row = mysql_fetch_assoc($res2) ){
	            $row[] = $row;
	        }
	         
	    }
	}
?>