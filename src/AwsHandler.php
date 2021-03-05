<?php

namespace RenokiCo\AwsElasticHandler;

use Aws\Credentials\Credentials;
use Aws\Signature\SignatureV4;
use Elasticsearch\ClientBuilder;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Ring\Future\CompletedFutureArray;
use Psr\Http\Message\ResponseInterface;

class AwsHandler
{
    /**
     * The configuration for Elasticsearch.
     *
     * @var array
     */
    protected $config;

    /**
     * Initialize the handler.
     *
     * @param  array  $config
     * @return void
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Invoke the handler function.
     *
     * @param  array  $request
     * @return \GuzzleHttp\Ring\Future\CompletedFutureArray
     */
    public function __invoke(array $request)
    {
        if (! $this->config['enabled'] ?? false) {
            $defaultHandler = ClientBuilder::defaultHandler();

            return $defaultHandler($request);
        }

        $psr7Handler = \Aws\default_http_handler();
        $signer = new SignatureV4('es', $this->config['aws_region']);

        $psr7Request = new Request(
            $request['http_method'],
            (new Uri($request['uri']))->withScheme($request['scheme'])->withHost($request['headers']['Host'][0]),
            $request['headers'],
            $request['body']
        );

        // Sign the PSR-7 request with credentials from the environment.
        $signedRequest = $signer->signRequest(
            $psr7Request,
            new Credentials(
                $this->config['aws_access_key_id'],
                $this->config['aws_secret_access_key'],
                $this->config['aws_session_token'] ?? null
            )
        );

        // Send the signed request to Amazon ES.
        $response = $psr7Handler($signedRequest)->then(function (ResponseInterface $response) {
            return $response;
        }, function ($error) {
            return $error['response'];
        })->wait();

        // Convert the PSR-7 response to a RingPHP response.
        return new CompletedFutureArray([
            'status' => $response->getStatusCode(),
            'headers' => $response->getHeaders(),
            'body' => $response->getBody()->detach(),
            'transfer_stats' => ['total_time' => 0],
            'effective_url' => (string) $psr7Request->getUri(),
        ]);
    }
}
