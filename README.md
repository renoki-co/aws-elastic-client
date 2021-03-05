AWS Elastic Client
==================

![CI](https://github.com/renoki-co/aws-elastic-client/workflows/CI/badge.svg?branch=master)
[![codecov](https://codecov.io/gh/renoki-co/aws-elastic-client/branch/master/graph/badge.svg)](https://codecov.io/gh/renoki-co/aws-elastic-client/branch/master)
[![StyleCI](https://github.styleci.io/repos/344591179/shield?branch=master)](https://github.styleci.io/repos/344591179)
[![Latest Stable Version](https://poser.pugx.org/renoki-co/aws-elastic-client/v/stable)](https://packagist.org/packages/renoki-co/aws-elastic-client)
[![Total Downloads](https://poser.pugx.org/renoki-co/aws-elastic-client/downloads)](https://packagist.org/packages/renoki-co/aws-elastic-client)
[![Monthly Downloads](https://poser.pugx.org/renoki-co/aws-elastic-client/d/monthly)](https://packagist.org/packages/renoki-co/aws-elastic-client)
[![License](https://poser.pugx.org/renoki-co/aws-elastic-client/license)](https://packagist.org/packages/renoki-co/aws-elastic-client)

Elastic Client handler for Laravel that supports AWS Elasticsearch service on [babenkoivan/elastic-client](https://github.com/babenkoivan/elastic-client).

## 🤝 Supporting

Renoki Co. on GitHub aims on bringing a lot of open source projects and helpful projects to the world. Developing and maintaining projects everyday is a harsh work and tho, we love it.

If you are using your application in your day-to-day job, on presentation demos, hobby projects or even school projects, spread some kind words about our work or sponsor our work. Kind words will touch our chakras and vibe, while the sponsorships will keep the open source projects alive.

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/R6R42U8CL)

## 🚀 Installation

You can install the package via composer:

```bash
composer require renoki-co/aws-elastic-client
```

This package comes with configuration for the Elastic Client, so you need to publish the config. This will create a `config/elastic.client.php` file:

```bash
$ php artisan vendor:publish --provider="ElasticClient\ServiceProvider"
```

## 🙌 Usage

By default, the `elastic.client.php` file looks like this:

```php
return [
    'hosts' => [
        env('ELASTIC_HOST', 'localhost:9200'),
    ],
];
```

To authenticate to AWS, you will need to define a `handler` key for each host:

```php
use RenokiCo\AwsElasticHandler\AwsHandler;

return [

    'hosts' => [
        [
            'host' => env('ELASTIC_HOST', '127.0.0.1'),
            'port' => env('ELASTIC_PORT', 9200),
            // the rest of ES configuration goes here...
        ],

        // ...
    ],

    'handler' => new AwsHandler([
        'enabled' => env('AWS_ELASTICSEARCH_ENABLED', false),
        'aws_access_key_id' => env('AWS_ACCESS_KEY_ID'),
        'aws_secret_access_key' => env('AWS_SECRET_ACCESS_KEY'),
        'aws_region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        'aws_session_token' => env('AWS_SESSION_TOKEN'), // optional
    ]),

];
```

## 🐛 Testing

``` bash
vendor/bin/phpunit
```

## 🤝 Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## 🔒  Security

If you discover any security related issues, please email alex@renoki.org instead of using the issue tracker.

## 🎉 Credits

- [Alex Renoki](https://github.com/rennokki)
- [All Contributors](../../contributors)
