<?php 
function translate($data){
    foreach ($data as $key => $value) {
       @ $result[$key] = addslashes($value);
    };
    $result['department'] = json_encode($data['department']);
    //此处可能存在安全漏洞
    return $result;
}
function isEmptyString($array){
    foreach ($array as $value) {
        if($value==''){
            return 1;
        }
    }
    return 0;
}
function isEmail($string){
    $law = "/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/i";
    if(preg_match($law,$string)){
        return true;
    }
    else{
        return false;
    }
}

function dataValidate($data){
    if(!is_numeric($data['studyNumber'])){
            $response['code'] = "1";
            $response['message'] = "学号数据类型出错";
            $response = json_encode($response);
            echo $response;
            unset($response);
            exit;
    }
    if(!is_numeric($data['qq'])){
        $response['code'] = "1";
        $response['message'] = "qq数据类型出错";
        $response = json_encode($response);
        echo $response;
        unset($response);
        exit;
    }
    if(!is_numeric($data['phone'])){
        $response['code'] = "1";
        $response['message'] = "手机号数据类型出错";
        $response = json_encode($response);
        echo $response;
        unset($response);
        exit;
    }
    if(!isEmail($data['email'])){
        $response['code'] = "1";
        $response['message'] = "email数据类型出错";
        $response = json_encode($response);
        echo $response;
        unset($response);
        exit;
    }
    if(strlen($data['studyNumber'])!=8){
        $response['code'] = "1";
        $response['message'] = "学号长度出错";
        $response = json_encode($response);
        echo $response;
        unset($response);
        exit;
    }
    if(strlen($data['qq'])>12){
        $response['code'] = "1";
        $response['message'] = "qq长度出错";
        $response = json_encode($response);
        echo $response;
        unset($response);
        exit;
    }
    if(strlen($data['phone'])>11){
        $response['code'] = "1";
        $response['message'] = "手机号长度出错";
        $response = json_encode($response);
        echo $response;
        unset($response);
        exit;
    }
    $evaluates = array('A+','A','A-','B+','B','B-','C');
    if(!in_array($data['evaluate'],$evaluates)){
        $response['code'] = "1";
        $response['message'] = "评价字符非法";
        $response = json_encode($response);
        echo $response;
        unset($response);
        exit;
    }
}

 ?>