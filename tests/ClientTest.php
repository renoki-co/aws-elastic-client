<?php

namespace RenokiCo\AwsElasticHandler\Test;

use Elasticsearch\Client;

class ClientTest extends TestCase
{
    public function test_aws_authentication()
    {
        $this->client->indices()->create([
            'index' => 'some-index',
        ]);
    }
}
