<?php

namespace RenokiCo\AwsElasticHandler\Test;

use Elasticsearch\Client;

class ClientTest extends TestCase
{
    public function test_aws_authentication()
    {
        $this->app['config']->set('elastic.client', [
            'hosts' => [[
                'host' => '127.0.0.1',
                'port' => 80,
            ]],
            'handler' => new AwsHandler([
                'enabled' => true,
                'aws_access_key_id' => 'SOME_ID',
                'aws_secret_access_key' => 'SOME_SECRET',
                'aws_region' => 'us-east-1',
            ]),
        ]);

        $this->client->indices()->create([
            'index' => 'some-index',
        ]);
    }

    public function test_no_aws_authentication()
    {
        $this->app['config']->set('elastic.client', [
            'hosts' => [[
                'host' => '127.0.0.1',
                'port' => 80,
            ]],
            'handler' => new AwsHandler([
                'enabled' => false,
                'aws_access_key_id' => 'SOME_ID',
                'aws_secret_access_key' => 'SOME_SECRET',
                'aws_region' => 'us-east-1',
            ]),
        ]);

        $this->client->indices()->create([
            'index' => 'some-index-2',
        ]);
    }
}
