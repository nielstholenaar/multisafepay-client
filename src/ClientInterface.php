<?php namespace Ntholenaar\MultiSafepayClient;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin;
use Ntholenaar\MultiSafepayClient\Api\ApiInterface;

interface ClientInterface
{
    /**
     * Set the API key.
     *
     * @param $apiKey
     * @return $this
     */
    public function setApiKey($apiKey);

    /**
     * Set the environment.
     *
     * @param $environment
     * @return $this
     */
    public function environment($environment);

    /**
     * @param $name
     * @throws \InvalidArgumentException
     * @return ApiInterface
     */
    public function api($name);

    /**
     * Add a new Http plugin.
     *
     * @param Plugin $plugin
     * @return Client
     */
    public function addPlugin(Plugin $plugin);

    /**
     * Get the http client.
     *
     * @return HttpMethodsClient
     */
    public function getHttpClient();
}
