<?php 
session_start();
if(isset($_SESSION['username'])&&(!empty($_SESSION['username']))){
//mysql connect
require_once("../config/config.php");

//
$id = $_GET['id'];
$id = intval($id);
$sql = "select * from user where id = $id";
if($res = $pdo1->query($sql,PDO::FETCH_ASSOC)){
	$res = $res->fetchAll();
	$res = $res[0];
	$res['direction'] = json_decode($res['direction']);
    var_dump($res);
    }
    else {
    	header("Location:index.html");
    	exit;
    }
}
else {
    header("Location:index.html");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>新生信息管理系统</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="../js/Undefined.js"></script>
</head>
<body style="background-color: black">
<div style="width:1300px;height:603px;background-image:url('../img/isa1.jpg');background-position: center;background-repeat: repeat-y">
    <!-- body -->
    <div class="row">
        <div style="height:100px"></div>
    </div>
    <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-1">
            <form id="modify-form" action="modify.php" method="POST" >
                <input type="hidden" maxlength="20" class="edit-message" style="width:150px;" name="id" value="<?php echo $res['id'];?>">
                <br/>

                <label style="width:100px;text-align:right;">姓名</label>
                <input type="text" maxlength="20" class="edit-message" style="width:200px;" name="name" value="<?php echo htmlspecialchars($res['name']);?>">
                <br/>
                <label style="width:100px;text-align:right;">学号</label>
                <input type="text" maxlength="8" class="edit-message" style="width:200px;" name="studyNumber" value="<?php echo htmlspecialchars($res['studyNumber']);?>">
                <br/>
                <label style="width:100px;text-align:right;">email</label>
                <input type="text" maxlength="60" class="edit-message" style="width:200px;" name="email" value="<?php echo htmlspecialchars($res['email']);?>">
                <br/>
                <label style="width:100px;text-align:right;">学院</label>
                <input type="text" maxlength="20" class="edit-message" style="width:200px;" name="college" value="<?php echo htmlspecialchars($res['college']);?>">
                <br/>
                <label style="width:100px;text-align:right;">专业</label>
                <input type="text" maxlength="20" class="edit-message" style="width:200px;" name="major" value="<?php echo htmlspecialchars($res['major']);?>">
                <br/>
                <label style="width:100px;text-align:right;">手机号</label>
                <input type="text" maxlength="20" class="edit-message" style="width:200px;" name="phone" value="<?php echo htmlspecialchars($res['phone']);?>">
                <br/>
                <label style="width:100px;text-align:right;">性别</label>
                <select name="sex"  class="edit-message">
				  <option value ="0" <?php if($res['sex']==0) echo "selected=\"selected\"";?>>男</option>
				  <option value ="1" <?php if($res['sex']==1) echo "selected=\"selected\"";?>>女</option>
				  <option value="2" <?php if($res['sex']==2) echo "selected=\"selected\"";?>>保密</option>
				</select>
                <br/>
                <label style="width:100px;text-align:right;">qq</label>
                <input type="text" maxlength="20" class="edit-message" style="width:200px;" name="qq" value="<?php echo htmlspecialchars($res['qq']);?>">
                <br/>
                <label style="width:100px;text-align:right;">自我介绍</label>
                <input type="text" maxlength="20" class="edit-message" style="width:200px;" name="Introduction" value="<?php echo htmlspecialchars($res['Introduction']);?>">
                <br/>
                <label style="width:100px;text-align:right;">备注</label>
                <input type="text" maxlength="20" class="edit-message" style="width:200px;" name="note" value="<?php echo htmlspecialchars($res['note']);?>">
                <br/>
                <label style="width:100px;text-align:right;">方向</label>
			      <div class="list-block">
			        <ul class="interest-ul" style="float:left;width:500px;">
			        	<?php 
			        		for($i=1;$i<9;$i++){
			        		switch ($i) {
			        			case '1':
			        				$depart_name = "渗透";
			        				break;
			        			case '2':
			        				$depart_name = "逆向";
			        				break;
			        			case '3':
			        				$depart_name = "网络";
			        				break;
			        			case '4':
			        				$depart_name = "无线";
			        				break;
			        			case '5':
			        				$depart_name = "Web开发";
			        				break;
			        			case '6':
			        				$depart_name = "Windows方向";
			        				break;
			        			case '7':
			        				$depart_name = "Linux方向";
			        				break;
			        			case '8':
			        				$depart_name = "其他";
			        				break;
			        			default:
			        				# code...
			        				break;
			        		}
			        		if(in_array($i,$res['direction'])){
			        			echo '<li><label class="label-checkbox item-content"><input type="checkbox" class="interest-checkbox" checked="checked" id="'.$i.'" name="ks-checkbox" /><div class="item-media"><i class="icon icon-form-checkbox"></i></div><div class="item-inner"><div class="item-title">'.$depart_name.'</div></div></label></li>';
			        		}
			        			else{
			        				echo '<li><label class="label-checkbox item-content"><input type="checkbox" class="interest-checkbox" id="'.$i.'" name="ks-checkbox" /><div class="item-media"><i class="icon icon-form-checkbox"></i></div><div class="item-inner"><div class="item-title">'.$depart_name.'</div></div></label></li>';
			        		}
			        	}
			        	?>
			        </ul>
			      </div>
			      <div class="content-block">
			        <div class="content-block-inner">
			          <p style="letter-spacing:1px;line-height:22px;color:#888">
			        </div>
			      </div>
                <br/>
                <label style="width:100px;text-align:right;">带领学长</label>
                <input type="text" maxlength="20" class="edit-message" style="width:200px;" name="seniorname" value="<?php echo htmlspecialchars($res['seniorname']);?>">
                <br/>
                <div style="width:500px;">
                    <input style="btn btn-outline-inverse btn-lg" class="btn" type="button" value="修改"  onclick="edit()" />
                    <br/><a href="user.php">返回新生列表</a>
            </form>
            <div class="row"><p id = "msg"></p></div>
        </div>
    </div>

</div>
</body>
</html>
