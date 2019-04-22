<?php
/**
 * Created by PhpStorm.
 * User: Nosirc
 * Date: 2019/1/9
 * Time: 11:10
 */
if ( ! function_exists('curl_post'))
{
    /**
     * crul post提交.
     *
     * @param  string $url
     * @param  array $params
     * @param  integer $timeout
     * @return string
     */
    function curl_post($url, array $params = [], $timeout = 5)
    {
        $ch = curl_init();//初始化
        curl_setopt($ch, CURLOPT_URL, $url);//抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        $data = curl_exec($ch);//运行curl
        curl_close($ch);
        return ($data);
    }
}

if ( ! function_exists('getClientIp'))
{
    /**
     * 客户端真实ip.
     * @return string
     */
    function getClientIp($type = 0) {
        $type       =  $type ? 1 : 0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos    =   array_search('unknown',$arr);
            if(false !== $pos) unset($arr[$pos]);
            $ip     =   trim($arr[0]);
        }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip     =   $_SERVER['HTTP_CLIENT_IP'];
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }
}


if ( ! function_exists('returnErrors'))
{
    /**
     * 统一返回错误.
     * @return array
     */
    function returnErrors($code, $message = '') {
        return [
            'status_code' => $code,
            'message'     => $message
        ];
    }
}