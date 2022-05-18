<?php

namespace zylkovroistat\parserHttpAccessLog\Service\Parser;

use zylkovroistat\parserHttpAccessLog\Model;
use zylkovroistat\parserHttpAccessLog\Exception;

class AccessLogParser implements LogParser
{

    /**
     * @var string
     */
    private string $_pathFileData;

    /**
     * @param string $pathFileData
     */
    public function __construct(string $pathFileData)
    {
        $this->_pathFileData = $pathFileData;
    }

    /**
     * @return Model\Access
     * @throws Exception\LogParserException
     */
    public function parse(): Model\Access
    {
        $result = [];

        if ( !file_exists($this->_pathFileData) ) {
            throw new Exception\LogParserException(sprintf('File %s not found.', $this->_pathFileData));
        }

        $fileStream = fopen($this->_pathFileData, 'r');

        if(!$fileStream){
            throw new Exception\LogParserException(sprintf('File %s open failed.', $this->_pathFileData));
        }

        if ($fileStream) {
            $lineNumber = -1;
            while (!feof($fileStream)) {
                $line = fgets($fileStream);
                $lineNumber++;
                $httpAccess = $this->_parseData($line, $lineNumber);
                if($httpAccess !== null){
                    $result[$lineNumber] = $httpAccess;
                }
            }
            fclose($fileStream);
        }
        return new Model\Access($result);
    }


    /**
     * @param string $data
     * @param int $lineNumber
     * @return Model\HttpAccess|null
     * @throws Exception\LogParserException
     */
    private function _parseData(string $data, int $lineNumber): ?Model\HttpAccess
    {
        /**
         * https://stackoverflow.com/questions/7603017/parse-apache-log-in-php-using-preg-match
         */
        $pattern = '/^(\S+) (\S+) (\S+) \[([^:]+):(\d+:\d+:\d+) ([^\]]+)\] \"(\S+) (.*?) (\S+)\" (\S+) (\S+) "([^"]*)" "([^"]*)"$/';
        $matches = [];
        $dataIsMatchedPattern = preg_match($pattern, $data, $matches);

        if($dataIsMatchedPattern){
            return new Model\HttpAccess($matches[1],
                $matches[4]." ".$matches[5]." ".$matches[6],
                $matches[9],
                $matches[7],
                $matches[8],
                $matches[13],
                $matches[12],
                $matches[10],
                $matches[11]);
        }

        if(!$dataIsMatchedPattern){
            throw new Exception\LogParserException(sprintf("String of data %s not matched pattern", $lineNumber++));
        }

        if($dataIsMatchedPattern === false){
            throw new Exception\LogParserException(sprintf("String of data %s cant check pattern", $lineNumber++));
        }

        return null;
    }
}