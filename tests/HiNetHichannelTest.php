<?php
/**
 * Copyright 2021 GoneTone
 *
 * HiNet hichannel 台灣電台
 * https://github.com/GoneToneStudio/php-hinet-hichannel-taiwan-radio
 *
 * @author   張文相 Zhang Wenxiang (旋風之音 GoneTone) <https://blog.reh.tw>
 * @license  MIT <https://github.com/GoneToneStudio/php-hinet-hichannel-taiwan-radio/blob/master/LICENSE>
 *
 * HiNetHichannel Test
 */

use GoneTone\HiNetHichannel;
use PHPUnit\Framework\TestCase;

/**
 * Class ShrinkURLTest
 */
class HiNetHichannelTest extends TestCase
{
    protected $_hichannel;

    /**
     * @throws Exception
     */
    protected function setUp(): void {
        $this->_hichannel = new HiNetHichannel("KISS RADIO 大眾廣播電台");
        $this->_hichannel->loadApi();
    }

    /**
     * 測試取得播放網址 (m3u8)
     *
     * @throws Exception
     */
    public function testGetPlayUrl() {
        $playUrl = $this->_hichannel->playUrl();
        $this->assertRegExp("/https?:\/\/(([a-zA-Z]|[a-zA-Z][a-zA-Z0-9\-]*[a-zA-Z0-9])\.)*([A-Za-z]|[A-Za-z][A-Za-z0-9\-]*[A-Za-z0-9])\/live\/[a-zA-Z0-9]+\/chunklist\.m3u8\?token=(.*)&expires=(.*)/i", $playUrl);
    }

    /**
     * 測試取得頻道名稱
     *
     * @throws Exception
     */
    public function testGetTitle() {
        $title = $this->_hichannel->title();
        $this->assertIsString($title);
    }

    /**
     * 測試取得頻道 ID
     *
     * @throws Exception
     */
    public function testGetId() {
        $id = $this->_hichannel->id();
        $this->assertIsString($id);
    }

    /**
     * 測試取得頻道描述
     *
     * @throws Exception
     */
    public function testGetDesc() {
        $desc = $this->_hichannel->desc();
        $this->assertIsString($desc);
    }

    /**
     * 測試取得頻道區域
     *
     * @throws Exception
     */
    public function testGetArea() {
        $area = $this->_hichannel->area();
        $this->assertIsString($area);
    }

    /**
     * 測試取得頻道類型
     *
     * @throws Exception
     */
    public function testGetType() {
        $type = $this->_hichannel->type();
        $this->assertIsString($type);
    }

    /**
     * 測試取得頻道圖片網址
     *
     * @throws Exception
     */
    public function testGetImageUrl() {
        $imageUrl = $this->_hichannel->imageUrl();
        $this->assertRegExp("/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&\/=]*)/i", $imageUrl);
    }

    /**
     * 測試取得頻道目前節目名稱
     *
     * @throws Exception
     */
    public function testGetNowProgramName() {
        $nowProgramName = $this->_hichannel->nowProgramName();
        $this->assertIsString($nowProgramName);
    }

    /**
     * 測試取得頻道節目表
     *
     * @throws Exception
     */
    public function testGetProgramList() {
        $programList = $this->_hichannel->programList();
        $this->assertIsArray($programList);
    }
}
