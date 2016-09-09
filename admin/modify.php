<?php 
//mysql connect
session_start();
if(isset($_SESSION['username'])&&(!empty($_SESSION['username']))){
require_once("../config/config.php");
include("../config/common.function.php");
if(!empty($_POST)){
    $data = $_POST['data'];
    $data = json_decode($data,true);
    $data = translate($data);
    $data['department'] = json_encode($data['department']);

        $sql = "update user set name='".$data['name']."', studyNumber='".$data['studyNumber']."', email='".$data['email']."',college='".$data['college']."',major='".$data['major']."',phone=".$data['phone'].",sex='".$data['sex']."',qq=".$data['qq'].",Introduction='".$data['Introduction']."',note='".$data['note']."',seniorname='".$data['seniorname']."',direction=".$data['department'].",evaluate='".$data['evaluate']."' where id =".$data['id'];
        dataValidate($data);
/*        if(isEmptyString($data)){
            $response['code'] = "1";
            $response['message'] = "信息不完整";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
        }
//后台修改默认可为空，若要修改请取消注释
        */
        if($pdo1->exec($sql)){
            $response['code'] = "0";
            $response['message'] = "修改成功!";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
        }
        else {
            $response['code'] = "1";
            $response['message'] = "信息不合法或无变化";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
        }
}
else {
    echo '404';
}
}
else {
    echo '403';
}
?>