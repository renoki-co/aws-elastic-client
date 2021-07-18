AWS Elastic Client Handler
==========================

![CI](https://github.com/renoki-co/aws-elastic-client/workflows/CI/badge.svg?branch=master)
[![codecov](https://codecov.io/gh/renoki-co/aws-elastic-client/branch/master/graph/badge.svg)](https://codecov.io/gh/renoki-co/aws-elastic-client/branch/master)
[![StyleCI](https://github.styleci.io/repos/344591179/shield?branch=master)](https://github.styleci.io/repos/344591179)
[![Latest Stable Version](https://poser.pugx.org/renoki-co/aws-elastic-client/v/stable)](https://packagist.org/packages/renoki-co/aws-elastic-client)
[![Total Downloads](https://poser.pugx.org/renoki-co/aws-elastic-client/downloads)](https://packagist.org/packages/renoki-co/aws-elastic-client)
[![Monthly Downloads](https://poser.pugx.org/renoki-co/aws-elastic-client/d/monthly)](https://packagist.org/packages/renoki-co/aws-elastic-client)
[![License](https://poser.pugx.org/renoki-co/aws-elastic-client/license)](https://packagist.org/packages/renoki-co/aws-elastic-client)

Custom Elasticsearch Client handler that signs the requests for AWS Elasticsearch service with provided IAM credentials.

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

To authenticate to AWS, you will need to set the handler that comes with this package:

```php
use RenokiCo\AwsElasticHandler\AwsHandler;

$awsHandler = new AwsHandler([
    'enabled' => true,
    'aws_access_key_id' => '...',
    'aws_secret_access_key' => '...',
    'aws_region' => 'us-east-1',
    'aws_session_token' => '...', // optional
]);

$client = ClientBuilder::create()
    ->setHosts(...)
    ->setHandler($awsHandler)
    ->build();
```

If you are building th client statically using `fromConfig()`, pass the `handler` parameter:

```php
use RenokiCo\AwsElasticHandler\AwsHandler;

$awsHandler = new AwsHandler([
    'enabled' => true,
    'aws_access_key_id' => '...',
    'aws_secret_access_key' => '...',
    'aws_region' => 'us-east-1',
    'aws_session_token' => '...', // optional
]);

$client = ClientBuilder::fromConfig([
    'hosts' => [
        //
    ],
    'handler' => $awsHandler,
]);
```

The package will make sure to sign each subsequent request that goes through with the IAM credentials you have provided.

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
