<?php

use GoneTone\HiNetHichannel;

require_once(dirname(dirname(dirname(__FILE__))) . "/vendor/autoload.php");

$hichannel = new HiNetHichannel("KISS RADIO 大眾廣播電台"); //請輸入完整頻道名稱

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
