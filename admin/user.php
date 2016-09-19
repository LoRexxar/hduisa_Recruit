<?php 
header("Content-type:text/html;charset=utf8");
session_start();
if(isset($_SESSION['username'])&&(!empty($_SESSION['username']))){
		//mysql connect
	require_once("../config/config.php");

	if(isset($_GET['pageId'])&&(intval($_GET['pageId'])!=0)){
		$pageId = intval($_GET['pageId']);
	}
	else{
		$pageId = 1;
	}
	$pageSize = 20;
	$sql = "select id from user";
		if($res = $pdo1->query($sql,PDO::FETCH_ASSOC)){
		$res = $res->fetchAll();
		$studentNum = count($res);
		$pages = ceil($studentNum/20);
	}
	$sql = "select * from user limit ".($pageId-1)*$pageSize.",".$pageSize;
	if($res = $pdo1->query($sql,PDO::FETCH_ASSOC)){
		$res = $res->fetchAll();
	}
}
else {
	header("Location:index.php");
}

?>
<?php 
	include("templates/header.php");
	include("templates/studentList.php");
	include("templates/pages.php");
 ?>