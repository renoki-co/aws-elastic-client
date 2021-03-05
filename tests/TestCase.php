<?php

namespace RenokiCo\AwsElasticHandler\Test;

use Elasticsearch\Client;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * The client interface.
     *
     * @var Elasticsearch\Client
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->client = $this->app->make(Client::class);
    }

    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app)
    {
        return [
            \ElasticClient\ServiceProvider::class,
            \RenokiCo\AwsElasticHandler\AwsElasticHandlerServiceProvider::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'wslxrEFGWY6GfGhvN9L3wH3KSRJQQpBD');
    }
}
