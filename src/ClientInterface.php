<?php namespace Ntholenaar\MultiSafepayClient;

use Http\Client\Common\Plugin;
use Ntholenaar\MultiSafepayClient\Request\GatewayRequest;
use Ntholenaar\MultiSafepayClient\Request\IssuerRequest;
use Ntholenaar\MultiSafepayClient\Request\OrderRequest;
use Psr\Http\Message\RequestInterface;

interface ClientInterface
{
    /**
     * Get the API endpoint.
     *
     * @return \Psr\Http\Message\UriInterface
     */
    public function getApiEndpoint();

    /**
     * Get the API path.
     *
     * @return \Psr\Http\Message\UriInterface
     */
    public function getApiPath();

    /**
     * Get the locale.
     *
     * @return string
     */
    public function getLocale();

    /**
     * Set the locale.
     *
     * @param $locale
     * @return $this
     */
    public function setLocale($locale);

    /**
     * Enable or disable the test environment.
     *
     * @param $testMode
     * @return $this
     */
    public function setTestMode($testMode);

    /**
     * Is the test environment active.
     *
     * @return bool
     */
    public function isTestModeEnabled();

    /**
     * Set the API key.
     *
     * @param $apiKey
     * @return $this
     */
    public function setApiKey($apiKey);

    /**
     * Add an Http plugin.
     *
     * @param Plugin $plugin
     * @return $this
     */
    public function addHttpPlugin(Plugin $plugin);

    /**
     * Execute the Http Request.
     *
     * @param RequestInterface $request
     * @return array|object
     */
    public function executeRequest(RequestInterface $request);

    /**
     * Create an GatewayRequest.
     *
     * @return GatewayRequest
     */
    public function createGatewayRequest();

    /**
     * Create an IssuerRequest.
     *
     * @return IssuerRequest
     */
    public function createIssuerRequest();

    /**
     * Create an OrderRequest.
     *
     * @return OrderRequest
     */
    public function createOrderRequest();

    /**
     * Create an new request.
     *
     * @param $resource
     * @return \Ntholenaar\MultiSafepayClient\Request\RequestInterface
     */
    public function createRequest($resource);
}
