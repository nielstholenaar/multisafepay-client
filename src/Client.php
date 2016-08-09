<?php namespace Ntholenaar\MultiSafepayClient;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\MessageFactory;
use Ntholenaar\MultiSafepayClient\Requests\ListGatewaysRequest;
use Ntholenaar\MultiSafepayClient\Requests\RequestInterface;

class Client
{
    /**
     * The endpoint of the test API.
     *
     * @var string
     */
    protected $testApiEndpoint = 'https://testapi.multisafepay.com/v1/json/';

    /**
     * The endpoint of the live API.
     *
     * @var string
     */
    protected $liveApiEndpoint = 'https://api.multisafepay.com/v1/json/';

    /**
     * The API key which will be used for authentication.
     *
     * @var string
     */
    protected $apiKey;

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
     * Indicates if the test mode is enabled.
     *
     * @var bool
     */
    protected $testMode = false;

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * Client constructor.
     *
     * @param HttpClient|null $httpClient
     * @param MessageFactory|null $messageFactory
     */
    public function __construct(HttpClient $httpClient = null, MessageFactory $messageFactory = null)
    {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();

        $this->messageFactory = $messageFactory ?: MessageFactoryDiscovery::find();
    }

    /**
     * {@inheritdoc}
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
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
    public function getTestMode()
    {
        return $this->testMode;
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
     * {@inheritdoc}
     */
    public function createListGatewaysRequest(array $parameters = array())
    {
        return new ListGatewaysRequest($parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function createOrderRequest(array $parameters)
    {
        //
    }

    /**
     * {@inheritdoc}
     */
    protected function getApiEndpoint()
    {
        if ($this->testMode) {
            return $this->testApiEndpoint;
        }

        return $this->liveApiEndpoint;
    }

    /**
     * {@inheritdoc}
     */
    public function executeRequest(RequestInterface $request)
    {
        $request = $request->compileRequest();

        $httpRequest = $this->messageFactory->createRequest(
            $request['method'],
            $this->getApiEndpoint() . $request['url'],
            ['api_key' => $this->getApiKey()],
            $request['body']
        );

        $response = $this->httpClient->sendRequest($httpRequest);

        return $response->getBody();
    }
}
