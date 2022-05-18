<?php

if (php_sapi_name() !== 'cli') {
    exit;
}

if ( file_exists(dirname(__FILE__).'/vendor/autoload.php') ) {
    require_once dirname(__FILE__).'/vendor/autoload.php';
}

use zylkovroistat\parserHttpAccessLog\Service;
use zylkovroistat\parserHttpAccessLog\Exception;

function dataMetric(int $views, int $urls, int $traffic, array $crawlers, array $statusCodes) : array
{
    return [
        'views' => $views,
        'urls' => $urls,
        'traffic' => $traffic,
        'crawlers' => $crawlers,
        'statusCodes' => $statusCodes
    ];

}

function printData(array $data) : void
{
    print_r(json_encode($data, JSON_PRETTY_PRINT));
}

function main($arguments) : void
{
    if(count($arguments)<=1)
    {
        throw new Exception\ApplicationException("One argument expected. Path to parsing file not defined");
    }

    if(count($arguments)>2)
    {
        throw new Exception\ApplicationException("One argument expected.");
    }

    if (count($arguments)==2)
    {
        $parser = new Service\Parser\AccessLogParser($arguments[1]);
        $dataAccess = $parser->parse();
        $metric = new Service\Metric($dataAccess);

        $data = dataMetric(
            $metric->getCountRequest(),
            count($metric->getCountUrl()),
            $metric->getAllSizeTraffic(),
            $metric->getCrawlers(),
            $metric->getCountStatusCode()
        );

        printData($data);
    }

}

main($argv);
