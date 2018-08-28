<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/22 0022
 * Time: 下午 3:58
 */

if(!function_exists('returnSuccess')){
    function returnSuccess ($data,$message=''){
        return response([
            'status' => '0',
            'data'=> $data,
            'msg'=> $message,
            'code' => ''
        ], 200);
    }
} 

if(!function_exists('returnFail')){
    function returnFail ($data,$message, $ercode){
        return response([
            'status' => '-1',
            'data'=> $data,
            'msg'=> $message,
            'code' => $ercode,
        ],200);
    }
}

if(!function_exists('returnError')){
    function returnError ($data,$message,$ercode, $code) {
        return response([
            'status' => '-1',
            'data'=> $data,
            'msg'=> $message,
            'code' => $ercode,
        ],$code);
    }
}

if (!function_exists('makeAuthToken')) {
    /**
     * 创造权限验证token
     * @return bool|string  md5 16位 不重复加密字符
     */
    function makeAuthToken() {
        return substr(md5(bcrypt(1)), 8, 16);#16位
    }
}




