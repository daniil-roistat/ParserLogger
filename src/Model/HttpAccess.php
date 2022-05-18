<?php

namespace zylkovroistat\parserHttpAccessLog\Model;

class HttpAccess
{
    /**
     * @var string
     */
    private string $_ip;

    /**
     * @var string
     */
    private string $_dateTime;

    /**
     * @var string
     */
    private string $_method;

    /**
     * @var string
     */
    private string $_url;

    /**
     * @var string
     */
    private string $_httpRefer;

    /**
     * @var int
     */
    private int $_responseStatusCode;

    /**
     * @var string
     */
    private string $_httpVersion;

    /**
     * @var int
     */
    private int $_sizeTraffic;

    /**
     * @var string
     */
    private string $_userAgent;


    /**
     * @param string $ip
     * @param string $dateTime
     * @param string $httpVersion
     * @param string $method
     * @param string $url
     * @param string $userAgent
     * @param string $httpRefer
     * @param int $responseStatusCode
     * @param int $sizeTraffic
     */
    public function __construct(string $ip, string $dateTime, string $httpVersion, string $method, string $url, string $userAgent, string $httpRefer, int $responseStatusCode, int $sizeTraffic)
    {
        $this->_ip = $ip;
        $this->_dateTime = $dateTime;
        $this->_method = $method;
        $this->_url = $url;
        $this->_httpRefer = $httpRefer;
        $this->_responseStatusCode = $responseStatusCode;
        $this->_httpVersion = $httpVersion;
        $this->_sizeTraffic = $sizeTraffic;
        $this->_userAgent = $userAgent;
    }

    /**
     * @return string
     */
    public function ip(): string
    {
        return $this->_ip;
    }

    /**
     * @return string
     */
    public function dateTime(): string
    {
        return $this->_dateTime;
    }

    /**
     * @return string
     */
    public function method(): string
    {
        return $this->_method;
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return $this->_url;
    }

    /**
     * @return string
     */
    public function httpRefer(): string
    {
        return $this->_httpRefer;
    }

    /**
     * @return int
     */
    public function responseStatusCode(): int
    {
        return $this->_responseStatusCode;
    }

    /**
     * @return string
     */
    public function httpVersion(): string
    {
        return $this->_httpVersion;
    }

    /**
     * @return int
     */
    public function sizeTraffic(): int
    {
        return $this->_sizeTraffic;
    }

    /**
     * @return string
     */
    public function userAgent(): string
    {
        return $this->_userAgent;
    }



}