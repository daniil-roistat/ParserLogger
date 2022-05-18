<?php
namespace zylkovroistat\parserHttpAccessLog\Service;

use zylkovroistat\parserHttpAccessLog\Model;

class Metric
{

    const USER_AGENT_WEBCRAWLERS = [
        'Google' => 'Googlebot',
        'Bing' => 'Bingbot',
        'Baidu' => 'Baiduspider',
        'Yandex' => 'YandexBot'
    ];

    /**
     * @var Model\Access
     */
    private Model\Access $_access;

    /**
     * @param Model\Access $access
     */
    public function __construct(Model\Access $access)
    {
        $this->_access = $access;
    }

    /**
     * @return int
     */
    public function getCountRequest() : int
    {
        return $this->_access->count();
    }

    /**
     * @return array<string, int>
     */
    public function getCountUrl() : array
    {
        $result = [];
        foreach ($this->_access->httpRequests() as $httpRequest) {
            if (array_key_exists($httpRequest->url(), $result)) {
                $result[$httpRequest->url()]++;
            }
            else {
                $result[$httpRequest->url()] = 1;
            }

        }
        return $result;
    }

    /**
     * @return int
     */
    public function getAllSizeTraffic() : int
    {
        $result = 0;
        foreach ($this->_access->httpRequests() as $httpRequest) {
            $result += $httpRequest->sizeTraffic();
        }
        return $result;
    }

    /**
     * @return array<string, int>
     */
    public function getCountStatusCode() : array
    {
        $result = [];
        foreach ($this->_access->httpRequests() as $httpRequest) {
            if (array_key_exists($httpRequest->responseStatusCode(), $result)) {
                $result[$httpRequest->responseStatusCode()]++;
            }
            else {
                $result[$httpRequest->responseStatusCode()] = 1;
            }
        }
        return $result;
    }

    /**
     * @return array<string, int>
     */
    public function getCrawlers(): array
    {
        $result = [];

        foreach (self::USER_AGENT_WEBCRAWLERS as $webcrawler => $userAgent){
            $result[$webcrawler] = 0;
        }

        foreach ($this->_access->httpRequests() as $httpRequest) {
            foreach (self::USER_AGENT_WEBCRAWLERS as $webcrawler => $userAgent){
                if(strpos($httpRequest->userAgent(), $userAgent) === false)
                {
                    continue;
                }
                else
                {
                    $result[$webcrawler]++;
                    break;
                }
            }
        }
        return $result;
    }
}