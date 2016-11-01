<?php namespace Ntholenaar\MultiSafepayClient\Api;

use Ntholenaar\MultiSafepayClient\Client;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractApi implements ApiInterface
{
    /**
     * HultiSafepay API Client.
     *
     * @var Client
     */
    protected $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Execute an Http GET request.
     *
     * @param $path
     * @param array $parameters
     * @return mixed
     */
    protected function get($path, array $parameters = array())
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        $response = $this->client->getHttpClient()->get($path);

        return $this->parseResponse($response);
    }

    /**
     * Execute an http POST request.
     *
     * @param $path
     * @param array $parameters
     * @param array $body
     * @return mixed
     */
    protected function post($path, array $parameters = array(), $body = array())
    {
        if (count($parameters) > 0) {
            $path .= '?' . http_build_query($parameters);
        }

        $body = json_encode($body);

        $response = $this->client->getHttpClient()->post($path, [], $body);

        return $this->parseResponse($response);
    }

    /**
     * Parse the response.
     *
     * @param ResponseInterface $response
     * @return mixed
     * @throws \Exception
     */
    protected function parseResponse(ResponseInterface $response)
    {
        $response = json_decode($response->getBody()->getContents());

        if (isset($response->success) && $response->success) {
            return $response->data;
        }

        throw new \Exception($response->error_info, $response->error_code);
    }
}
