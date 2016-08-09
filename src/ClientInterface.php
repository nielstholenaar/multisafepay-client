<?php namespace Ntholenaar\MultiSafepayClient;

use Ntholenaar\MultiSafepayClient\Requests\RequestInterface;
use Psr\Http\Message\StreamInterface;

interface ClientInterface
{
    /**
     * Get the API key.
     *
     * @return string
     */
    public function getApiKey();

    /**
     * Set the API key.
     *
     * @param $apiKey
     * @return $this
     */
    public function setApiKey($apiKey);

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
     * Indicates if the test mode is active.
     *
     * @return bool
     */
    public function getTestMode();

    /**
     * Enable / disable the test mode.
     *
     * @param $testMode
     * @return $this
     */
    public function setTestMode($testMode);

    /**
     * Retrieve all the available payment gateways.
     *
     * @param array $parameters
     * @return RequestInterface
     */
    public function createListGatewaysRequest(array $parameters = array());

    /**
     * Create an order request.
     *
     * @param array $parameters
     * @return RequestInterface
     */
    public function createOrderRequest(array $parameters);


    /**
     * Execute the request.
     *
     * @param RequestInterface $request
     * @return StreamInterface
     */
    public function executeRequest(RequestInterface $request);
}
