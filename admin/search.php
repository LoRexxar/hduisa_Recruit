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
<!DOCTYPE html>
<html>
<head>
	<title>HDUISA新生后台管理系统</title>
	    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Undefined.css">
    <link rel="stylesheet" href="../css/LoRexxar.css">
    <link rel="stylesheet" href="../css/styles.css"> 	
    <script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
<div class="container back" style="height: 100vh; width: 100vw; margin-top:0px">
	<div class="row head container">
		<div class="navbar-header">
			<p class="navbar-brand">Welcome <?php echo htmlspecialchars($_SESSION['username']);?></p>
			<a class="navbar-brand head-text" href="javascript:;" onclick="logout()">退出</a>
			<p class="navbar-brand head-text" id="msg"></p>
		</div>

		<?php include("searchForm.php");?>
	</div>

	<div class="row"></div>

	<div class="row">
		<h2 class="sub-header" style="color: #FFF; text-align:center;">新生数据</h2>
		<div class="col-md-1"></div>
		<div class="col-md-10 table-responsive" style="border: 1px solid #ddd; border-radius:5px">
			<div class="row-fluid">
				<div class="span12">
					<table id="namelist" class="table table-striped">
					<thead>
						<tr>
			                <th>id</th>
			                <th>name</th>
			                <th>sex</th>
			                <th>seniorname</th>
		                </tr>
              		</thead>
					<tbody>
						<?php 
						foreach ($res as $new) {
							# code...
							if($new['sex']=='0'){
								$new['sex'] = "男";
							}
							elseif($new['sex'] == '1'){
								$new['sex'] = "女";
							}
							else{
								$new['sex'] = "保密";
							}
							echo "<tr><td>No.".$new['id']."</td><td>"."<a style=\"color: #FFF;\" href='student.php?id=".$new['id']."'>".htmlspecialchars($new['name'])."</a></td><td>".$new['sex']."</td><td>study with ".htmlspecialchars($new['seniorname'])."</td></tr>";
						};
						?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="row" style="text-align:center; ">
		<div id="pagelist" class="pagination">
			<ul>
				<li>
					<a   style="color: #FFF; margin-right: 20px;" href="search.php?<?php echo 'field='.$field.'&keywords='.$keywords.'&pageId=';if(($pageId-1)>0){echo $pageId-1;}else{echo $pages;};?>">上一页</a>
				</li>
				<?php 
					for($i=1;$i<=$pages;$i++){
						echo "<li>";
						echo "<a style=\"color: #FFF;\" href='"."search.php?field=".$field."&keywords=".$keywords."&pageId=".$i."'>".$i."</a>";
						echo "</li>";
					}
				?>
				<li>
					<a style="color: #FFF; margin-left: 20px;" href="search.php?<?php echo 'field='.$field.'&keywords='.$keywords.'&pageId=';if(($pageId+1)<$pages){echo $pageId+1;}else{echo $pages;};?>">下一页</a>
				</li>
			</ul>
		</div>
	</div>
	    <script type="text/javascript" src="../js/Undefined.js"></script>
</body>
</html>