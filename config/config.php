<?php 
    $myhost="localhost";
    $myname="root";
    $mypass="";
    	$pdo1 = new PDO("mysql:host=".$myhost.";dbname=hduisa_reg",$myname,$mypass);
    	$pdo2 = new PDO("mysql:host=".$myhost.";dbname=hduisa_reg_admin",$myname,$mypass);
 	//判断是否连接成功
	if(!$pdo1||!$pdo2){
    	die("数据库连接失败");
	}
	$sql = "set character set 'utf8';set names 'utf8'";
	if(!$pdo1->query($sql)||!$pdo2->query($sql)){
		die("编码设置失败");
	}
        //密钥 default:NzU0MzU3ZTJjM2ZkMDA5ZjU2ZWYxMzJkMjVjMWVkMWQ=
$key = base64_encode(md5('hduisa'));
 ?>
