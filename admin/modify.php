<?php 
//mysql connect
session_start();
if(isset($_SESSION['username'])&&(!empty($_SESSION['username']))){
require_once("../config/config.php");
include("../config/common.function.php");
if(!empty($_POST)){
    $data = $_POST['data'];
    $data = json_decode($data,true);
    $data['department'] = json_encode($data['department']);

        $sql = "update user set name=:name,studyNumber=:studyNumber,email=:email,college=:college,major=:major,phone=:phone,sex=:sex,qq=:qq,Introduction=:Introduction,note=:note,direction=:direction,evaluate=:evaluate,seniorname=:seniorname where id=:id";
/*        $sql = "insert into user(name,studyNumber,email,college,major,phone,sex,qq,Introduction,note,direction) values(:name,:studyNumber,:email,:college,:major,:phone,:sex,:qq,:Introduction,:note,:direction)";*/
        $res = $pdo1->prepare($sql);
        $res->bindValue(":name",$data['name']);
        $res->bindValue("id",$data['id']);
        $res->bindValue("studyNumber",$data['studyNumber'],PDO::PARAM_INT);
        $res->bindValue(":email",$data['email']);
        $res->bindValue(":college",$data['college']);
        $res->bindValue(":major",$data['major']);
        $res->bindValue(":phone",$data['phone'],PDO::PARAM_INT);
        $res->bindValue(":sex",$data['sex']);
        $res->bindValue(":qq",$data['qq'],PDO::PARAM_INT);
        $res->bindValue(":Introduction",$data['Introduction']);
        $res->bindValue(":note",$data['note']);
        $res->bindValue(":direction",$data['department']);
        $res->bindValue(":evaluate",$data['evaluate']);
        $res->bindValue(":seniorname",$data['seniorname']);
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
        if($res->execute()){
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