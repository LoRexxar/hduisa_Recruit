<?php 
		//mysql connect
	session_start();
	require_once("../config/config.php");

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

        if(empty($data['password'])){
            $response['code'] = "1";
            $response['message'] = "密码不能为空";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
    }
    //
    	$username = $data['username'];
    	$password = md5($data['password']);
        $sql = "select * from user where username='$username' and password='$password'";
       	if($res = $pdo2->query($sql,PDO::FETCH_ASSOC)){
        $res = $res->fetchAll();
        if(!empty($res)){
            $_SESSION['username'] = $username;
            $response['code'] = "2";
            $response['message'] = htmlspecialchars($username);
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
        }
        else{
            $response['code'] = "1";
            $response['message'] = "帐号或密码错误";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
        }
        }
}
else {
    echo '404';
}

    function translate($data){
    foreach ($data as $key => $value) {
       @ $result[$key] = addslashes($value);
    };
    return $result;
    }
