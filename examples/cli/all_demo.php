<?php

use GoneTone\HiNetHichannel;
//use GoneTone\Proxy;

require_once(dirname(dirname(dirname(__FILE__))) . "/vendor/autoload.php");

/*
 * 連線到 Proxy 伺服器
 * 如果運行此程式的伺服器不在台灣，請設定台灣的 Proxy 伺服器，否則取得的串流網址會驗證失敗 (HTTP 403 Forbidden)，但如果播放端 IP 在國外一樣會被阻擋就是了。
 */
//$proxy = new Proxy("主機名", 3128, "http");
//$proxy->login("帳號", "密碼"); //如果 Proxy 伺服器需要驗證，請調用這登入

$hichannel = new HiNetHichannel("KISS RADIO 大眾廣播電台"); //請輸入完整頻道名稱
//$hichannel = new HiNetHichannel("KISS RADIO 大眾廣播電台", $proxy); //Proxy

try {
    /* 加載 HiNet hichannel API */
    $hichannel->loadApi();

    /* 取得 HiNet hichannel m3u8 串流網址 */
    echo "m3u8 串流網址：" . $hichannel->playUrl() . "\n";

    /* 取得 HiNet hichannel 頻道名稱 */
    echo "頻道名稱：" . $hichannel->title() . "\n";

    /* 取得 HiNet hichannel 頻道 ID */
    echo "頻道 ID：" . $hichannel->id() . "\n";

    /* 取得 HiNet hichannel 頻道描述 */
    echo "頻道描述：" . $hichannel->desc() . "\n";

    /* 取得 HiNet hichannel 頻道區域 */
    echo "頻道區域：" . $hichannel->area() . "\n";

    /* 取得 HiNet hichannel 頻道類型 */
    echo "頻道類型：" . $hichannel->type() . "\n";

    /* 取得 HiNet hichannel 頻道圖片網址 */
    echo "頻道圖片網址：" . $hichannel->imageUrl() . "\n";

    /* 取得 HiNet hichannel 頻道目前節目名稱 */
    echo "頻道目前節目名稱：" . $hichannel->nowProgramName() . "\n";

    /* 取得 HiNet hichannel 頻道節目表 */
    echo "頻道節目表：\n";
    print_r($hichannel->programList());
} catch (Exception $e) {
    echo $e->getMessage();
}
