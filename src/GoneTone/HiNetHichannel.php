<?php
/**
 * Copyright 2020 GoneTone
 *
 * HiNet hichannel 台灣電台
 * https://github.com/GoneToneStudio/php-hinet-hichannel-taiwan-radio
 *
 * @author   張文相 Zhang Wenxiang (旋風之音 GoneTone) <https://blog.reh.tw>
 * @license  MIT <https://github.com/GoneToneStudio/php-hinet-hichannel-taiwan-radio/blob/master/LICENSE>
 */

namespace GoneTone;

use Exception;

class HiNetHichannel extends Request
{
    protected $_hichannelChannelName;
    protected $_hichannel;
    protected $_loadApi;

    /**
     * HiNetHichannel constructor.
     *
     * @param string $hichannelChannelName Hichannel 頻道名稱
     */
    public function __construct(string $hichannelChannelName) {
        parent::__construct();

        $this->_hichannelChannelName = $hichannelChannelName;

        $this->_hichannel = new hichannelApi($hichannelChannelName);
        $this->_loadApi = false;
    }

    /**
     * 加載 API
     *
     * @throws Exception
     */
    public function loadApi() {
        $api = $this->_hichannel->loadApi();
        if ($api) {
            $this->_loadApi = true;
        } else {
            throw new Exception("Hichannel 頻道名稱「" . $this->_hichannelChannelName . "」廣播電台找不到或資料取得失敗。");
        }
    }

    /**
     * Hichannel 播放網址 (m3u8)
     *
     * @return string
     *
     * @throws Exception
     */
    public function playUrl(): string {
        if ($this->_loadApi) {
            $m3u8Url = $this->_hichannel->m3u8Url();

            if (!$m3u8Url) {
                throw new Exception("Hichannel 頻道名稱「" . $this->_hichannelChannelName . "」廣播電台 m3u8 網址取得失敗。");
            }

            $check = array();
            for ($i = 0; $i < 10; $i++) {
                $check = parent::checkUrl($m3u8Url);
                if ($check["status"]) {
                    return $m3u8Url;
                }
            }

            throw new Exception("取得的 Hichannel 頻道名稱「" . $this->_hichannelChannelName . "」廣播電台 m3u8 網址檢查失敗：" . $check["msg"]);
        }

        throw new Exception("Hichannel API 未加載。");
    }

    /**
     * Hichannel 頻道名稱
     *
     * @return string 回傳頻道名稱
     *
     * @throws Exception
     */
    public function title(): string {
        if ($this->_loadApi) {
            $title = $this->_hichannel->title();

            if (!$title) {
                throw new Exception("Hichannel 頻道名稱「" . $this->_hichannelChannelName . "」廣播電台頻道名稱取得失敗。");
            }

            return $title;
        }

        throw new Exception("Hichannel API 未加載。");
    }

    /**
     * Hichannel 頻道 ID
     *
     * @return string 回傳頻道 ID
     *
     * @throws Exception
     */
    public function id(): string {
        if ($this->_loadApi) {
            $id = $this->_hichannel->id();

            if (!$id) {
                throw new Exception("Hichannel 頻道名稱「" . $this->_hichannelChannelName . "」廣播電台頻道 ID 取得失敗。");
            }

            return $id;
        }

        throw new Exception("Hichannel API 未加載。");
    }

    /**
     * Hichannel 頻道描述
     *
     * @return string 回傳頻道描述
     *
     * @throws Exception
     */
    public function desc(): string {
        if ($this->_loadApi) {
            $desc = $this->_hichannel->desc();

            if (!$desc) {
                throw new Exception("Hichannel 頻道名稱「" . $this->_hichannelChannelName . "」廣播電台頻道描述取得失敗。");
            }

            return $desc;
        }

        throw new Exception("Hichannel API 未加載。");
    }

    /**
     * Hichannel 頻道區域
     *
     * @return string 回傳頻道區域
     *
     * @throws Exception
     */
    public function area(): string {
        if ($this->_loadApi) {
            $area = $this->_hichannel->area();

            if (!$area) {
                throw new Exception("Hichannel 頻道名稱「" . $this->_hichannelChannelName . "」廣播電台頻道區域取得失敗。");
            }

            return $area;
        }

        throw new Exception("Hichannel API 未加載。");
    }

    /**
     * Hichannel 頻道類型
     *
     * @return string 回傳頻道類型
     *
     * @throws Exception
     */
    public function type(): string {
        if ($this->_loadApi) {
            $type = $this->_hichannel->type();

            if (!$type) {
                throw new Exception("Hichannel 頻道名稱「" . $this->_hichannelChannelName . "」廣播電台頻道類型取得失敗。");
            }

            return $type;
        }

        throw new Exception("Hichannel API 未加載。");
    }

    /**
     * Hichannel 頻道圖片網址
     *
     * @return string 回傳頻道圖片網址
     *
     * @throws Exception
     */
    public function imageUrl(): string {
        if ($this->_loadApi) {
            $imageUrl = $this->_hichannel->imageUrl();

            if (!$imageUrl) {
                throw new Exception("Hichannel 頻道名稱「" . $this->_hichannelChannelName . "」廣播電台頻道圖片網址取得失敗。");
            }

            return $imageUrl;
        }

        throw new Exception("Hichannel API 未加載。");
    }

    /**
     * Hichannel 頻道節目表
     *
     * @return array 回傳頻道節目表
     *
     * @throws Exception
     */
    public function programList(): array {
        if ($this->_loadApi) {
            $programList = $this->_hichannel->programList();

            if (!$programList) {
                throw new Exception("Hichannel 頻道名稱「" . $this->_hichannelChannelName . "」廣播電台頻道節目表取得失敗。");
            }

            return $programList;
        }

        throw new Exception("Hichannel API 未加載。");
    }

    /**
     * Hichannel 頻道目前節目名稱
     *
     * @return string 回傳頻道目前節目名稱
     *
     * @throws Exception
     */
    public function nowProgramName(): string {
        if ($this->_loadApi) {
            $nowProgramName = $this->_hichannel->nowProgramName();

            if (!$nowProgramName) {
                throw new Exception("Hichannel 頻道名稱「" . $this->_hichannelChannelName . "」廣播電台頻道目前節目名稱取得失敗。");
            }

            return $nowProgramName;
        }

        throw new Exception("Hichannel API 未加載。");
    }
}
