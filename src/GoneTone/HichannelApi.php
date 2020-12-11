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
 * Hichannel Api
 */

namespace GoneTone;

use Chrisyue\PhpM3u8\Facade\ParserFacade;
use Chrisyue\PhpM3u8\Stream\TextStream;
use Exception;

class HichannelApi extends Request
{
    protected $_hichannelChannelName;
    protected $_hichannelChannelID;
    protected $_hichannelApiPlayerUrlData;
    protected $_hichannelApiProgramListData;
    protected $_hichannelApiProgramNowData;

    protected $_hichannelRadioPath = "/radio/";
    protected $_hichannelImagePath = "/upload/radio/channel/";

    protected $_hichannelApiChannelList = "channelList.do";
    protected $_hichannelApiPlayerUrl = "cp.do";
    protected $_hichannelApiProgramList = "getProgramList.do";
    protected $_hichannelApiProgramNow = "getNowProgram.do";

    /**
     * HichannelApi constructor.
     *
     * @param string $hichannelChannelName Hichannel 頻道名稱
     * @param ?Proxy $proxy                代理伺服器 (預設不使用代理)
     */
    public function __construct(string $hichannelChannelName, ?Proxy $proxy = null) {
        parent::__construct($proxy);

        $this->_hichannelChannelName = $hichannelChannelName;
    }

    /**
     * 加載 API
     *
     * @return bool 回傳結果
     *
     * @throws Exception
     */
    public function loadApi(): bool {
        try {
            $hichannelChannelIDRequest = parent::getApiData($this->_hichannelRadioPath . $this->_hichannelApiChannelList . "?keyword=" . urlencode($this->_hichannelChannelName));
            $hichannelChannelList = $hichannelChannelIDRequest["list"];
            if (count($hichannelChannelList) > 0) {
                $hichannelChannelTitle = $hichannelChannelList[0]["channel_title"];
                if ($hichannelChannelTitle === $this->_hichannelChannelName) {
                    $this->_hichannelChannelID = $hichannelChannelList[0]["channel_id"];

                    $this->_hichannelApiPlayerUrlData = parent::getApiData($this->_hichannelRadioPath . $this->_hichannelApiPlayerUrl . "?id=" . $this->_hichannelChannelID);
                    $this->_hichannelApiProgramListData = parent::getApiData($this->_hichannelRadioPath . $this->_hichannelApiProgramList . "?channelId=" . $this->_hichannelChannelID);
                    $this->_hichannelApiProgramNowData = parent::getApiData($this->_hichannelRadioPath . $this->_hichannelApiProgramNow . "?id=" . $this->_hichannelChannelID);

                    return true;
                }
            }

            return false;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * m3u8 串流網址
     *
     * @return false|string 回傳 m3u8 串流網址 (失敗回傳 false)
     *
     * @throws Exception
     */
    public function m3u8Url() {
        $data = $this->_hichannelApiPlayerUrlData;

        $m3u8Url = $data["_adc"];
        if ($m3u8Url) {
            try {
                $m3u8Data = parent::getM3u8UrlData($m3u8Url);

                $parseUrl = parse_url($m3u8Url);

                $parser = new ParserFacade();
                $parserM3u8Url = $parser->parse(new TextStream($m3u8Data));

                return $parseUrl["scheme"] . "://" . $parseUrl["host"] . str_replace("index.m3u8", $parserM3u8Url["EXT-X-STREAM-INF"][0]["uri"], $parseUrl["path"]);
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }

        return false;
    }

    /**
     * 頻道名稱
     *
     * @return ?string 回傳頻道名稱
     */
    public function title(): ?string {
        $data = $this->_hichannelApiProgramListData;
        return $data["channel_title"];
    }

    /**
     * 頻道 ID
     *
     * @return ?string 回傳頻道 ID
     */
    public function id(): ?string {
        return $this->_hichannelChannelID;
    }

    /**
     * 頻道描述
     *
     * @return ?string 回傳頻道描述
     */
    public function desc(): ?string {
        $data = $this->_hichannelApiProgramListData;
        return $data["channel_desc"];
    }

    /**
     * 頻道區域
     *
     * @return ?string 回傳頻道區域
     */
    public function area(): ?string {
        $data = $this->_hichannelApiProgramListData;
        return $data["channel_area"];
    }

    /**
     * 頻道類型
     *
     * @return ?string 回傳頻道類型
     */
    public function type(): ?string {
        $data = $this->_hichannelApiProgramListData;
        return $data["channel_type"];
    }

    /**
     * 頻道圖片網址
     *
     * @return ?string 回傳頻道圖片網址
     */
    public function imageUrl(): ?string {
        $data = $this->_hichannelApiProgramListData;
        return $this->_hichannelUrl . $this->_hichannelImagePath . $data["channel_image"];
    }

    /**
     * 頻道節目表
     *
     * @return ?array 回傳頻道節目表
     */
    public function programList(): ?array {
        $data = $this->_hichannelApiProgramListData;
        return $data["list"];
    }

    /**
     * 頻道目前節目名稱
     *
     * @return ?string 回傳頻道目前節目名稱
     */
    public function nowProgramName(): ?string {
        $data = $this->_hichannelApiProgramNowData;
        return $data["programName"];
    }
}
