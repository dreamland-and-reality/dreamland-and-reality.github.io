<?php
//定义TOKEN密钥
define("TOKEN", "XYuMe");
//实例化微信对象
$wechatObj = new wechatCallbackapiTest();
if(isset($_GET['echostr'])){
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}
//定义类文件
class wechatCallbackapiTest
{
    //实现valid验证方法，实现对接微信公众平台
    public function valid()
    {
        //接收随机字符串
        $echoStr = $_GET["echostr"];
 
        //进行用户数字签名验证
        if($this->checkSignature()){
            //如果成功，则返回接收到的随机字符串
            ob_clean();
            echo $echoStr;
            //退出  
            exit;
        }
    }
 
    
        
 
    //定义checkSignature
    private function checkSignature()
    {
        //接收微信解密签名
        $signature = $_GET["signature"];
        //接收微信解密签名
        $timestamp = $_GET["timestamp"];
        //接收随机数
        $nonce = $_GET["nonce"];    
        //把TOKEN常量赋值给$token变量
        $token = TOKEN;
        //把相关参数组装为数组
        $tmpArr = array($token, $timestamp, $nonce);
        //通过字典法进行排序
        sort($tmpArr);
        //把排序后的数组转化字符串
        $tmpStr = implode( $tmpArr );
        //通过哈希算法对字符串进行加密操作
        $tmpStr = sha1( $tmpStr );
        //与加密签名进行对比
        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }
}
 
?>
