AWS Elastic Client Handler
==========================

![CI](https://github.com/renoki-co/aws-elastic-client/workflows/CI/badge.svg?branch=master)
[![codecov](https://codecov.io/gh/renoki-co/aws-elastic-client/branch/master/graph/badge.svg)](https://codecov.io/gh/renoki-co/aws-elastic-client/branch/master)
[![StyleCI](https://github.styleci.io/repos/344591179/shield?branch=master)](https://github.styleci.io/repos/344591179)
[![Latest Stable Version](https://poser.pugx.org/renoki-co/aws-elastic-client/v/stable)](https://packagist.org/packages/renoki-co/aws-elastic-client)
[![Total Downloads](https://poser.pugx.org/renoki-co/aws-elastic-client/downloads)](https://packagist.org/packages/renoki-co/aws-elastic-client)
[![Monthly Downloads](https://poser.pugx.org/renoki-co/aws-elastic-client/d/monthly)](https://packagist.org/packages/renoki-co/aws-elastic-client)
[![License](https://poser.pugx.org/renoki-co/aws-elastic-client/license)](https://packagist.org/packages/renoki-co/aws-elastic-client)

Just a simple Elasticsearch Client handler that signs the requests for AWS Elasticsearch service with the provided credentials.

## 🤝 Supporting

[<img src="https://github-content.s3.fr-par.scw.cloud/static/18.jpg" height="210" width="418" />](https://github-content.renoki.org/github-repo/18)

If you are using one or more Renoki Co. open-source packages in your production apps, in presentation demos, hobby projects, school projects or so, spread some kind words about our work or sponsor our work via Patreon. 📦

[<img src="https://c5.patreon.com/external/logo/become_a_patron_button.png" height="41" width="175" />](https://www.patreon.com/bePatron?u=10965171)

## 🚀 Installation

You can install the package via composer:

```bash
composer require renoki-co/aws-elastic-client
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
