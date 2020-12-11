<?php
/**
 * Copyright 2020 GoneTone
 *
 * HiNet hichannel 台灣電台
 * https://github.com/GoneToneStudio/php-hinet-hichannel-taiwan-radio
 *
 * @author   張文相 Zhang Wenxiang (旋風之音 GoneTone) <https://blog.reh.tw>
 * @license  MIT <https://github.com/GoneToneStudio/php-hinet-hichannel-taiwan-radio/blob/master/LICENSE>
 *
 * Request
 */

namespace GoneTone;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;

class Request
{
    protected $_client;

    protected $_hichannelUrl = "https://hichannel.hinet.net";
    protected $_userAgent = "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36";

    /**
     * Request constructor.
     *
     * @param ?Proxy $proxy 代理伺服器 (預設不使用代理)
     */
    protected function __construct(?Proxy $proxy = null) {
        if ($proxy) {
            $this->_client = new Client([
                "verify" => false,
                "headers" => [
                    "User-Agent" => $this->_userAgent,
                    "Referer" => "https://hichannel.hinet.net/radio/index.do"
                ],
                "proxy" => $proxy
            ]);
        } else {
            $this->_client = new Client([
                "verify" => false,
                "headers" => [
                    "User-Agent" => $this->_userAgent,
                    "Referer" => "https://hichannel.hinet.net/radio/index.do"
                ]
            ]);
        }
    }

    /**
     * 取得 API 資料
     *
     * @param string $path 網址路徑
     *
     * @return ?array 取得的資料
     *
     * @throws Exception
     */
    protected function getApiData(string $path): ?array {
        try {
            $response = $this->_client->request("GET", $path, [
                "base_uri" => $this->_hichannelUrl
            ]);

            if ($response->getStatusCode() === 200) {
                return json_decode($response->getBody(), true);
            }

            throw new Exception("無法取得資料。");
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * 取得 m3u8 串流網址資料
     *
     * @param string $url m3u8 串流網址
     *
     * @return StreamInterface 取得的資料
     *
     * @throws Exception
     */
    protected function getM3u8UrlData(string $url): StreamInterface {
        try {
            $response = $this->_client->request("GET", $url);

            if ($response->getStatusCode() === 200) {
                return $response->getBody();
            }

            throw new Exception("取得 m3u8 串流網址資料失敗。");
        } catch (GuzzleException $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * 檢查網址狀態碼是否是 200
     *
     * @param string $url 網址
     *
     * @return array 結果
     */
    protected function checkUrl(string $url): array {
        try {
            $response = $this->_client->request("GET", $url);

            if ($response->getStatusCode() === 200) {
                return array(
                    "status" => true,
                    "msg" => $response->getStatusCode() . " " . $response->getReasonPhrase()
                );
            }

            return array(
                "status" => false,
                "msg" => $response->getStatusCode() . " " . $response->getReasonPhrase()
            );
        } catch (GuzzleException $e) {
            return array(
                "status" => false,
                "msg" => $e->getMessage()
            );
        }
    }
}
