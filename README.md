# HiNet hichannel 台灣電台 (PHP 套件)
取得 HiNet hichannel 台灣電台的 m3u8 串流網址、節目表和其他資訊！

Node.js 版本：[https://github.com/GoneToneStudio/node-hinet-hichannel-taiwan-radio](https://github.com/GoneToneStudio/node-hinet-hichannel-taiwan-radio)

## 注意
- HiNet hichannel m3u8 串流網址會阻擋國外 IP 訪問 (HTTP 403 Forbidden)。
- 收聽端 IP 和用來取得 m3u8 串流網址的伺服器 IP 要是相同的，不然無法播放 (HTTP 403 Forbidden)，目前正在研究如何克服，方法大致上知道怎麼做，只是需要時間。

## 問題
如果發現任何 BUG，請在此回報：[https://github.com/GoneToneStudio/php-hinet-hichannel-taiwan-radio/issues](https://github.com/GoneToneStudio/php-hinet-hichannel-taiwan-radio/issues)

## 安裝
### Composer
    composer require gonetone/hinet-hichannel-taiwan-radio

## 取得 Hichannel 頻道名稱方法
1. 前往 [HiNet hichannel 網站](https://hichannel.hinet.net/)
2. 點選您想要聽的電台並確認可以播放
3. 複製完整頻道名稱，使用時名稱要完全一樣 (如果不能直接複製可以利用 F12，或者就乖乖用打的XDD)

## 使用方法
### 使用 HiNetHichannel 物件
```php
$hichannel = new HiNetHichannel("Hichannel 完整頻道名稱 (string)");
```

### 取得 m3u8 串流網址
```php
try {
    $hichannel->loadApi(); //加載 HiNet hichannel API
    echo $hichannel->playUrl(); //HiNet hichannel m3u8 串流網址 (string)
} catch (Exception $e) {
    echo $e->getMessage();
}
```

### 取得頻道名稱
```php
try {
    $hichannel->loadApi(); //加載 HiNet hichannel API
    echo $hichannel->title(); //HiNet hichannel 頻道名稱 (string)
} catch (Exception $e) {
    echo $e->getMessage();
}
```

### 取得頻道 ID
```php
try {
    $hichannel->loadApi(); //加載 HiNet hichannel API
    echo $hichannel->id(); //HiNet hichannel 頻道 ID (string)
} catch (Exception $e) {
    echo $e->getMessage();
}
```

### 取得頻道描述
```php
try {
    $hichannel->loadApi(); //加載 HiNet hichannel API
    echo $hichannel->desc(); //HiNet hichannel 頻道描述 (string)
} catch (Exception $e) {
    echo $e->getMessage();
}
```

### 取得頻道區域
```php
try {
    $hichannel->loadApi(); //加載 HiNet hichannel API
    echo $hichannel->area(); //HiNet hichannel 頻道區域 (string)
} catch (Exception $e) {
    echo $e->getMessage();
}
```

### 取得頻道類型
```php
try {
    $hichannel->loadApi(); //加載 HiNet hichannel API
    echo $hichannel->type(); //HiNet hichannel 頻道類型 (string)
} catch (Exception $e) {
    echo $e->getMessage();
}
```

### 取得頻道圖片網址
```php
try {
    $hichannel->loadApi(); //加載 HiNet hichannel API
    echo $hichannel->imageUrl(); //HiNet hichannel 頻道圖片網址 (string)
} catch (Exception $e) {
    echo $e->getMessage();
}
```

### 取得頻道節目表
```php
try {
    $hichannel->loadApi(); //加載 HiNet hichannel API
    print_r($hichannel->programList()); //HiNet hichannel 頻道節目表 (array)
} catch (Exception $e) {
    echo $e->getMessage();
}
```

### 取得頻道目前節目名稱
```php
try {
    $hichannel->loadApi(); //加載 HiNet hichannel API
    echo $hichannel->nowProgramName(); //HiNet hichannel 頻道目前節目名稱 (string)
} catch (Exception $e) {
    echo $e->getMessage();
}
```

## 範例
### 完整範例
```php
use GoneTone\HiNetHichannel;

require_once(dirname(__FILE__) . "/vendor/autoload.php");

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
```

### 網頁播放電台範例
請看 [examples/webpage/play_radio.php](examples/webpage/play_radio.php)

## 補充
如果需要取得新資料，必須再次調用 `$hichannel->loadApi()` 才會取得最新資料。
```php
try {
    /* 加載 HiNet hichannel API */
    $hichannel->loadApi();

    /* 取得最新 HiNet hichannel m3u8 串流網址 */
    echo "m3u8 串流網址：" . $hichannel->playUrl() . "\n";

    /* 取得最新 HiNet hichannel 頻道目前節目名稱 */
    echo "頻道目前節目名稱：" . $hichannel->nowProgramName() . "\n";
} catch (Exception $e) {
    echo $e->getMessage();
}
```

## License
[MIT](LICENSE)
