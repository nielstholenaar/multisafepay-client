<?php namespace Ntholenaar\MultiSafepayClient;

use Ntholenaar\MultiSafepayClient\Request\ListGatewaysRequest;
use Ntholenaar\MultiSafepayClient\Request\RequestInterface;

interface ClientInterface
{
    /**
     * Get the locale.
     *
     * @return string
     */
    public function getLocale();

    /**
     * Set the locale.
     *
     * @param string $locale
     * @return $this
     */
    public function setLocale($locale);

    /**
     * Get the environment.
     *
     * @return string
     */
    public function getEnvironment();

    /**
     * Enable or disable the test mode.
     *
     * @param $testMode
     * @return $this
     */
    public function setTestMode($testMode);

    /**
     * Create the list gateways request.
     *
     * @param array $parameters
     * @return ListGatewaysRequest
     */
    public function createListGatewaysRequest(array $parameters = array());

    /**
     * Execute the request.
     *
     * @param RequestInterface $request
     * @return array|object
     * @throws \Exception
     */
    public function executeRequest(RequestInterface $request);
}
