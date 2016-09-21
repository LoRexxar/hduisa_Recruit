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
		@$field = addslashes($_GET['field']);
		@$keywords = addslashes($_GET['keywords']);
		if($field == 'studyNumber'){
			$sql = "select * from user where studyNumber like '%".$keywords."%'";
		}
		elseif($field == 'name'){
			$sql = "select * from user where name like '%".$keywords."%'";
		}
		elseif($field == 'oldDriver'){
			$sql = "select * from user where seniorname like'%".$keywords."%'";
		}
		elseif($field == 'evaluate'){
			$sql = "select * from user where evaluate like'%".$keywords."%'";
		}
		elseif($field == 'direction'){
			$sql1 = "select id from department where depart_name like '%".$keywords."%' limit 1";
			if($res = $pdo1->query($sql1,PDO::FETCH_ASSOC)){
				$res = $res->fetchAll();
				$dirId = $res[0]['id'];
			}
			else{
				die("something wrong at getId");
			}
			$sql = "select * from user where direction like'%\"".$dirId."\"%'";
		}
		else{
			$sql = "select * from user";
		}
	$pageSize = 20;
		if($res = $pdo1->query($sql,PDO::FETCH_ASSOC)){
		$res = $res->fetchAll();
		$studentNum = count($res);
		$pages = $studentNum/20;
		if($studentNum%20>0){
			$pages+=1;
		}
	}
	$sql = $sql." limit ".($pageId-1)*$pageSize.",".$pageSize;
	if($res = $pdo1->query($sql,PDO::FETCH_ASSOC)){
		$res = $res->fetchAll();
	}
}
else {
	die("404");
}

?>
<?php 
	include("templates/header.php");
	include("templates/studentList.php");
	include("templates/pages.php");
 ?>