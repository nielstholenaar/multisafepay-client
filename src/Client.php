<?php namespace Ntholenaar\MultiSafepayClient;

use Http\Client\HttpClient;
use Ntholenaar\MultiSafepayClient\Request\FetchGatewayRequest;
use Ntholenaar\MultiSafepayClient\Request\FetchOrderRequest;
use Ntholenaar\MultiSafepayClient\Request\ListGatewaysRequest;
use Ntholenaar\MultiSafepayClient\Request\ListIssuersRequest;
use Ntholenaar\MultiSafepayClient\Request\RequestInterface;

class Client implements ClientInterface
{
    /**
     * Optional ISO 639-1 language code.
     *
     * The localization parameter determines the language which is used to
     * display gateway information and other messages in the responses.
     * The default language is English.
     *
     * @var string
     */
    protected $locale;

    /**
     * @var bool
     */
    protected $testMode = false;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @param HttpClient $httpClient Client to do HTTP requests.
     */
    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * {@inheritdoc}
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setTestMode($testMode)
    {
        $this->testMode = $testMode;

        return $this;
    }

    /**
     * Get the environment.
     *
     * @return string
     */
    public function getEnvironment()
    {
        return $this->testMode ? 'test' : 'live';
    }

    /**
     * Parse the parameters.
     *
     * @param array $parameters
     * @return array
     */
    protected function compileParameters(array $parameters)
    {
        $locale = $this->getLocale();

        if ($locale) {
            $parameters = array_merge(compact('locale'), $parameters);
        }

        return $parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function createListGatewaysRequest(array $parameters = array())
    {
        return new ListGatewaysRequest(
            $this->getEnvironment(),
            $this->compileParameters($parameters)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createFetchGatewayRequest(array $parameters = array())
    {
        return new FetchGatewayRequest(
            $this->getEnvironment(),
            $this->compileParameters($parameters)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createListIssuersRequest(array $parameters = array())
    {
        return new ListIssuersRequest(
            $this->getEnvironment(),
            $this->compileParameters($parameters)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function createFetchOrderRequest(array $parameters = array())
    {
        return new FetchOrderRequest(
            $this->getEnvironment(),
            $this->compileParameters($parameters)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function executeRequest(RequestInterface $request)
    {
        $response = $this->httpClient->sendRequest(
            $request->compileHttpRequest()
        );

        // Convert the PSR ResponseInterface.
        $body = $response->getBody()->getContents();

        $data = json_decode($body);

        if (property_exists($data, 'success') && $data->success !== true) {
            throw new \Exception($data->error_info, $data->error_code);
        }

        return $data->data;
    }
}
