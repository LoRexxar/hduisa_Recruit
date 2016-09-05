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
    <script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="../js/Undefined.js"></script>
</head>
<body style="background-color: black">
<div style="background-color: pink">
	<div class="row">~</div>
	<div class="row">
	<div class="col-md-1"></div>
		<div class="col-md-1">
			<p>Welcome <?php echo htmlspecialchars($_SESSION['username']);?></p>
		</div>
		<div class="col-md-1"><a href="javascript:;" onclick="logout()">退出</a><p id="msg"></p></div>
		<div class="col-md-4"></div>
		<div class="col-md-4">
			    <form class="form-search"  action="search.php" method="GET">
			    <Select NAME="field">   
				<Option VALUE="name">姓名</option>   
				<Option VALUE="oldDriver">老司机</option>  
				<Option VALUE="studyNumber">学号</option>    
				</Select> 
      				<input type="text" class="input-medium search-query" name="keywords">
      				<button type="submit" class="btn">Search</button>
    			</form>
		</div>
	</div>
	<div class="row"></div>
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="row-fluid">
				<div class="span12" style="height:450px">
					<ol id="namelist">
						<?php foreach ($res as $new) {
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
							echo "<li>No.".$new['id']." "."<a href='student.php?id=".$new['id']."'>".htmlspecialchars($new['name'])."</a>"."*".$new['sex']." study with ".htmlspecialchars($new['seniorname'])."</li>";
						};?>
					</ol>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
							<div id="pagelist" class="pagination">
						<ul>
							<li>
								<a href="search.php?<?php echo 'field='.$field.'&keywords='.$keywords.'&pageId=';if(($pageId-1)>0){echo $pageId-1;}else{echo $pages;};?>">上一页</a>
							</li>
							<?php
								for($i=1;$i<=$pages;$i++){
									echo "<li>";
									echo "<a href='"."search.php?field=".$field."&keywords=".$keywords."&pageId=".$i."'>".$i."</a>";
									echo "</li>";
								}
							?>
							<li>
								<a href="search.php?<?php echo 'field='.$field.'&keywords='.$keywords.'&pageId=';if(($pageId+1)<$pages){echo $pageId+1;}else{echo $pages;};?>">下一页</a>
							</li>
						</ul>
					</div>
	</div>
</body>
</html>