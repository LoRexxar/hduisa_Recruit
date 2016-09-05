<?php
	session_start();
	session_unset();
	session_destroy();
	$response['code'] = "0";
        $response['message'] = "退出成功";
        $response = json_encode($response);
        echo $response;
        unset($response);
        exit;
 ?>