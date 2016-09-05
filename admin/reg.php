<?php 
	//mysql connect
	require_once("../config/config.php");
//
if(!empty($_POST)){
    $data = $_POST['data']; 
    $data = json_decode($data,true);
    $data = translate($data);
    if(empty($data['username'])){
            $response['code'] = "1";
            $response['message'] = "用户名不能为空";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
    }
    if(checkuser($data['username'],$pdo2)){
        $response['code'] = "1";
        $response['message'] = "用户已存在";
        $response = json_encode($response);
        echo $response;
        unset($response);
        exit;
    }
    if($data['password1']!=$data['password2']){
	    $response['code'] = "1";
        $response['message'] = "两次密码不同";
        $response = json_encode($response);
        echo $response;
        unset($response);
        exit;
    }
        if(empty($data['password1'])){
            $response['code'] = "1";
            $response['message'] = "密码不能为空";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
    }
    //验证密钥
        if($data['manageKey'] != $key){
            $response['code'] = "1";
            $response['message'] = "密钥未通过";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
    }

        $sql = "insert into user(username,password) values('".$data['username']."','".md5($data['password1'])."')";
        if($pdo2->exec($sql)){
            $response['code'] = "0";
            $response['message'] = "注册成功!";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
        }
        else {
            $response['code'] = "1";
            $response['message'] = "信息不完整";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
        }
}
else {
    echo '404';
}
/*$sql = "INSERT INTO user(username,password) values('".$username."','".$password1."')";
echo $sql;
*/

    function translate($data){
    foreach ($data as $key => $value) {
       @ $result[$key] = addslashes($value);
    };
    return $result;
    }


    function checkuser($name,$pdo2){
        $sql = "select * from user where username='$name'";
        if($res = $pdo2->query($sql,PDO::FETCH_ASSOC)){
        $res = $res->fetchAll();
        if(!empty($res)){
            return true;
        }
        else{
            return false;
        }
        }
        else{
            $response['code'] = "1";
            $response['message'] = "查询失败";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
        }
    }
?>
