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
 * Proxy
 */

namespace GoneTone;

class Proxy
{
    protected $_host;
    protected $_port;
    protected $_protocol;
    protected $_username;
    protected $_password;

    /**
     * Proxy constructor.
     *
     * @param string $host     主機名
     * @param int    $port     端口 (預設 3128)
     * @param string $protocol 協定 (預設 http)
     */
    public function __construct(string $host, int $port = 3128, string $protocol = "http") {
        $this->_host = $host;
        $this->_port = $port;
        $this->_protocol = $protocol;
    }

    /**
     * 登入
     *
     * @param string $username 帳號
     * @param string $password 密碼
     */
    public function login(string $username, string $password) {
        $this->_username = $username;
        $this->_password = $password;
    }

    /**
     * @return string
     */
    public function __toString(): string {
        $url = $this->_host . ":" . $this->_port;

        $proxy = $this->_protocol . "://" . $url;
        if ($this->_username && $this->_password) {
            $proxy = $this->_protocol . "://" . $this->_username . ":" . $this->_password . "@" . $url;
        }

        return $proxy;
    }
}
