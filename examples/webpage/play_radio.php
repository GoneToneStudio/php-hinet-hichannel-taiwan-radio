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

$playUrl = null;
$title = "無法取得";
$nowProgramName = "無法取得";
try {
    /* 加載 HiNet hichannel API */
    $hichannel->loadApi();

    /* 取得 HiNet hichannel m3u8 串流網址 */
    $playUrl = $hichannel->playUrl();

    /* 取得 HiNet hichannel 頻道名稱 */
    $title = $hichannel->title();

    /* 取得 HiNet hichannel 頻道目前節目名稱 */
    $nowProgramName = $hichannel->nowProgramName();
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="utf-8">
    <title>網頁播放電台 Demo | HiNet hichannel 台灣電台 (PHP 套件)</title>

    <link href="//vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet">
</head>
<body>
<h1>網頁播放電台 Demo | HiNet hichannel 台灣電台 (PHP 套件)</h1>
<h2>GitHub：<a href="https://github.com/GoneToneStudio/php-hinet-hichannel-taiwan-radio" target="_blank">https://github.com/GoneToneStudio/php-hinet-hichannel-taiwan-radio</a>
</h2>

<p>電台名稱：<?php echo $title; ?>
    <br>現在正在播放節目名稱：<?php echo $nowProgramName; ?></p>

<audio id="hichannel" class="video-js vjs-default-skin" controls preload="auto" data-setup='{}'>
    <source src="<?php echo $playUrl; ?>" type="application/x-mpegURL">
</audio>

<script src="//vjs.zencdn.net/7.10.2/video.js"></script>
</body>
</html>
