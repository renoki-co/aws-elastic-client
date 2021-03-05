<?php

namespace RenokiCo\AwsElasticHandler\Test;

use Elasticsearch\Client;
use Elasticsearch\Common\Exceptions\NoNodesAvailableException;
use RenokiCo\AwsElasticHandler\AwsHandler;
class ClientTest extends TestCase
{
    public function test_aws_authentication()
    {
        $this->app['config']->set('elastic.client', [
            'hosts' => [[
                'host' => '127.0.0.1',
                'port' => 9200,
            ]],
            'handler' => new AwsHandler([
                'enabled' => true,
                'aws_access_key_id' => 'SOME_ID',
                'aws_secret_access_key' => 'SOME_SECRET',
                'aws_region' => 'us-east-1',
            ]),
        ]);

        $client = $this->app->make(Client::class);

        $client->indices()->create([
            'index' => 'some-index-1',
        ]);

        $this->assertTrue(
            $client->indices()->exists(['index' => 'some-index-1'])
        );
    }

    public function test_no_aws_authentication()
    {
        $this->app['config']->set('elastic.client', [
            'hosts' => [[
                'host' => '127.0.0.1',
                'port' => 9200,
            ]],
            'handler' => new AwsHandler([
                'enabled' => false,
                'aws_access_key_id' => 'SOME_ID',
                'aws_secret_access_key' => 'SOME_SECRET',
                'aws_region' => 'us-east-1',
            ]),
        ]);

        $client = $this->app->make(Client::class);

        $client->indices()->create([
            'index' => 'some-index-2',
        ]);

        $this->assertTrue(
            $client->indices()->exists(['index' => 'some-index-2'])
        );
    }

    public function test_error_authentication()
    {
        $this->app['config']->set('elastic.client', [
            'hosts' => [[
                'host' => '127.0.0.1',
                'port' => 3306,
            ]],
            'handler' => new AwsHandler([
                'enabled' => true,
                'aws_access_key_id' => 'SOME_ID',
                'aws_secret_access_key' => 'SOME_SECRET',
                'aws_region' => 'us-east-1',
            ]),
        ]);

        $client = $this->app->make(Client::class);

        $this->expectException(NoNodesAvailableException::class);

        $client->indices()->create([
            'index' => 'some-index-3',
        ]);
    }
}
