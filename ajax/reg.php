<?php 
//mysql connect
require_once("../config/config.php");
include("../config/common.function.php");
//
if(!empty($_POST)){
    $data = $_POST['data'];
    $data = json_decode($data,true);
    $data = translate($data);
    $data['department'] = json_encode($data['department']);

        $sql = "insert into user(name,studyNumber,email,college,major,phone,sex,qq,Introduction,note,direction) values('".$data['userName']."','".$data['studyNumber']."','".$data['email']."','".$data['college']."','".$data['major']."','".$data['phone']."',".$data['userSex'].",'".$data['qq']."','".$data['selfIntro']."','".$data['remark']."',".$data['department'].")";


        dataValidate($data);
        if(isEmptyString($data)){
            $response['code'] = "1";
            $response['message'] = "信息不完整";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
        }
        if($pdo1->exec($sql)){
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

?>