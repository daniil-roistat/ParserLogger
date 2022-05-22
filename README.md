# ParserLogger

Analyze and parsing http access_log.

## :toolbox: Dependencies

* PHP >= 7.4

## :hammer_and_pick: Install

`$ composer install`

## :checkered_flag: Run

`$ php parser.php <Path to access log>`

## :page_with_curl: Example Run

```
$ php parser.php testlog.txt
{
    "views": 16,
    "urls": 5,
    "traffic": 212816,
    "crawlers": {
        "Google": 2,
        "Bing": 0,
        "Baidu": 0,
        "Yandex": 0
    },
    "statusCodes": {
        "200": 14,
        "301": 2
    }
}
```

## :scroll: License

The scripts in this project are under the [MIT License](LICENSE).
