<?php

namespace zylkovroistat\parserHttpAccessLog\Model;

class Access
{
    /**
     * @var HttpAccess[]
     */
    private array $_httpRequests;

    /**
     * @var int
     */
    private int $_count;

    /**
     * @param HttpAccess[] $httpRequests
     */
    public function __construct(array $httpRequests)
    {
        $this->_httpRequests = $httpRequests;
        $this->_count = count($httpRequests);
    }

    /**
     * @return HttpAccess[]
     */
    public function httpRequests(): array
    {
        return $this->_httpRequests;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->_count;
    }




}