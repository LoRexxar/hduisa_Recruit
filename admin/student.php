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
    }
    else {
    	header("Location:index.php");
    	exit;
    }
}
else {
    header("Location:index.php");
    exit;
}
?>
<?php include("templates/header.php");?>

    <div class="row">
        <div class="col-md-3">
        </div>

        <div class="col-md-1">

            <form id="modify-form" class="form-signin" action="modify.php" method="POST" >
                <div class="row froms" style="float:left">
                <input type="hidden" maxlength="20" class="form-control edit-message" style="width:150px;" name="id" value="<?php echo $res['id'];?>">
                </div>
                
                <div class="row froms">
                <h4 class="white" >姓名:</h4>
                <input type="text" maxlength="20" class="form-control edit-message" style="margin-top: 9px" name="name" value="<?php echo htmlspecialchars($res['name']);?>">
                </div>

                <div class="row froms">
                <h4 class="white" style="display:inline;">学号:</h4>
                <input type="text" maxlength="8" class="form-control edit-message" style="margin-top: 9px" name="studyNumber" value="<?php echo htmlspecialchars($res['studyNumber']);?>">
                </div>

                <div class="row froms">
                <h4 class="white" style="display:inline;">email:</h4>
                <input type="text" maxlength="60" class="form-control edit-message" style="margin-top: 9px" name="email" value="<?php echo htmlspecialchars($res['email']);?>">
                 </div>

                <div class="row froms">
                <h4 class="white" style="display:inline;">学院:</h4>
                <input type="text" maxlength="20" class="form-control edit-message" style="margin-top: 9px" name="college" value="<?php echo htmlspecialchars($res['college']);?>">
                </div>

                <div class="row froms">
                <h4 class="white" style="display:inline;">专业:</h4>
                <input type="text" maxlength="20" class="form-control edit-message" style="margin-top: 9px" name="major" value="<?php echo htmlspecialchars($res['major']);?>">
                </div>

                <div class="row froms"> 
                <h4 class="white" style="display:inline;">手机号:</h4>
                <input type="text" maxlength="20" class="form-control edit-message" style="margin-top: 9px" name="phone" value="<?php echo htmlspecialchars($res['phone']);?>">
                </div>

                <div class="row froms">
                <h4 class="white" style="display:inline;">性别:</h4>
                <select name="sex"  class="form-control edit-message">
				  <option value ="0" <?php if($res['sex']==0) echo "selected=\"selected\"";?>>男</option>
				  <option value ="1" <?php if($res['sex']==1) echo "selected=\"selected\"";?>>女</option>
				  <option value="2" <?php if($res['sex']==2) echo "selected=\"selected\"";?>>保密</option>
				</select>
                </div>

                <div class="row froms">
                <h4 class="white" style="display:inline;">qq:</h4>
                <input type="text" maxlength="12" class="form-control edit-message" style="margin-top: 9px" name="qq" value="<?php echo htmlspecialchars($res['qq']);?>">
                </div>

                <div class="row froms">
                <h4 class="white" style="display:inline;">自我介绍:</h4>
                <textarea class="form-control edit-message" style="margin-top: 9px" name="Introduction">
                    <?php echo htmlspecialchars($res['Introduction']);?>
                </textarea>
                </div>

                <div class="row froms">
                <h4 class="white" style="display:inline;" >备注:</h4>
                <textarea class="form-control edit-message" style="margin-top: 9px" name="note">
                    <?php echo htmlspecialchars($res['note']);?>
                </textarea>
                </div>

                <div class="row froms">
                <h4 class="white" style="display:inline;">方向:</h4>
			      <div class="list-block">
			        <ul class="interest-ul" style="float:left;width:500px;"><div class="row">
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
			        			echo '<div class="col-md-4"><li><label class="label-checkbox item-content"><input type="checkbox" class="interest-checkbox" checked="checked" id="'.$i.'" name="ks-checkbox" /><div class="item-media"><i class="icon icon-form-checkbox"></i></div><div class="item-inner"><div class="item-title">'.$depart_name.'</div></div></label></li></div>';
			        		}
			        			else{
			        				echo '<div class="col-md-4"><li><label class="label-checkbox item-content"><input type="checkbox" class="interest-checkbox" id="'.$i.'" name="ks-checkbox" /><div class="item-media"><i class="icon icon-form-checkbox"></i></div><div class="item-inner"><div class="item-title">'.$depart_name.'</div></div></label></li></div>';
			        		}
			        	}
			        	?>
				</div>
			        </ul>
			      </div>
			      <div class="content-block">
			        <div class="content-block-inner">
			          <p style="letter-spacing:1px;line-height:22px;color:#888">
			        </div>
			      </div>
                </div>

                     <div class="row froms">
                <h4 class="white" style="display:inline;">评价:</h4>
                  <select class="form-control edit-message" name="evaluate" >
                    <option value="A+" <?php if(htmlspecialchars($res['evaluate'])=="A+")echo "selected=\"selected\"";?>>A+ 棒棒哒</option>
                    <option value="A" <?php if(htmlspecialchars($res['evaluate'])=="A")echo "selected=\"selected\"";?>>A </option>
                    <option value="A-" <?php if(htmlspecialchars($res['evaluate'])=="A-")echo "selected=\"selected\"";?>>A- </option>
                    <option value="B+" <?php if(htmlspecialchars($res['evaluate'])=="B+")echo "selected=\"selected\"";?>>B+ 挺不错</option>
                    <option value="B" <?php if(htmlspecialchars($res['evaluate'])=="B")echo "selected=\"selected\"";?>>B</option>
                    <option value="B-" <?php if(htmlspecialchars($res['evaluate'])=="B-")echo "selected=\"selected\"";?>>B-</option>
                    <option value="C" <?php if(htmlspecialchars($res['evaluate'])=="C")echo "selected=\"selected\"";?>>C 还需努力</option>
                  </select>
                </div>

                <div class="row froms">
                <h4 class="white" style="display:inline;">学长:</h4>
                <input type="text" maxlength="20" class="form-control edit-message" style="width:200px;" name="seniorname" value="<?php echo htmlspecialchars($res['seniorname']);?>">
                </div>

                <div style="width:500px;">
                    <input style="btn btn-outline-inverse btn-lg" class="btn" type="button" value="修改"  onclick="edit()" />
                    <br/><a href="user.php">返回新生列表</a>
            </form>
            <div class="row"><p id = "msg"></p></div>
        </div>
    </div>

</div>
    <script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
    <script type="text/javascript" src="../js/Undefined.js"></script>
</body>
</html>
