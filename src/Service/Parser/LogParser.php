<?php

namespace zylkovroistat\parserHttpAccessLog\Service\Parser;

use zylkovroistat\parserHttpAccessLog\Model;

interface LogParser
{
    /**
     * @return Model\Access
     */
    public function parse(): Model\Access;
}