<?php 
    header("Content-Type:text/html;charset=utf8");
    require_once("../config/config.php");
    //adjust referer;
    if(!isset($_SERVER['HTTP_REFERER'])){
        die("page not found");
    }

    $sql = "select * from department";
    if($res = $pdo1->query($sql,PDO::FETCH_ASSOC)){
    	$json = json_encode($res->fetchAll());
        echo $json;
    }
    else {
        die("查询失败");
    }
 ?>
