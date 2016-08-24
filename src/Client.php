<?php namespace Ntholenaar\MultiSafepayClient;

use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery;
use Http\Message\UriFactory;
use Ntholenaar\MultiSafepayClient\Exception\InvalidRequestException;
use Ntholenaar\MultiSafepayClient\Http\Plugin\Authentication;
use Ntholenaar\MultiSafepayClient\Http\Plugin\PrependPathPlugin;
use Ntholenaar\MultiSafepayClient\Request\GatewayRequest;
use Ntholenaar\MultiSafepayClient\Request\IssuerRequest;
use Ntholenaar\MultiSafepayClient\Request\OrderRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

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
     * @var PluginClient
     */
    protected $pluginClient;

    /**
     * @var UriFactory
     */
    protected $uriFactory;

    /**
     * @var array
     */
    protected $plugins = array();

    /**
     * @param HttpClient $httpClient
     * @param UriFactory|null $uriFactory
     */
    public function __construct(HttpClient $httpClient = null, UriFactory $uriFactory = null)
    {
        if (is_null($httpClient)) {
            $httpClient = Discovery\HttpClientDiscovery::find();
        }

        if (is_null($uriFactory)) {
            $uriFactory = Discovery\UriFactoryDiscovery::find();
        }

        $this->setHttpClient($httpClient);

        $this->setUriFactory($uriFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function getApiEndpoint()
    {
        if ($this->isTestModeEnabled()) {
            return $this->uriFactory->createUri('https://testapi.multisafepay.com');
        }

        return $this->uriFactory->createUri('https://api.multisafepay.com');
    }

    /**
     * {@inheritdoc}
     */
    public function getApiPath()
    {
        return $this->uriFactory->createUri('/v1/json/');
    }

    /**
     * Get the UriFactory.
     *
     * @return UriFactory
     */
    protected function getUriFactory()
    {
        return $this->uriFactory;
    }

    /**
     * Set the UriFactory.
     *
     * @param UriFactory $uriFactory
     * @return $this
     */
    protected function setUriFactory(UriFactory $uriFactory)
    {
        $this->uriFactory = $uriFactory;

        return $this;
    }

    /**
     * Get the HttpClient.
     *
     * @return HttpClient
     */
    protected function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Set the HttpClient.
     *
     * @param HttpClient $httpClient
     * @return $this
     */
    protected function setHttpClient(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;

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
    public function setTestMode($testMode)
    {
        $this->testMode = $testMode;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isTestModeEnabled()
    {
        return $this->testMode;
    }

    /**
     * {@inheritdoc}
     */
    public function setApiKey($apiKey)
    {
        $this->addHttpPlugin(
            new Plugin\AuthenticationPlugin(
                new Authentication\MultiSafepayAuthentication($apiKey)
            )
        );

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function addHttpPlugin(Plugin $plugin)
    {
        $this->plugins[] = $plugin;

        $this->invalidatePluginClient();

        return $this;
    }

    /**
     * Invalidate the PluginClient instance.
     *
     * @return $this
     */
    protected function invalidatePluginClient()
    {
        $this->pluginClient = null;

        return $this;
    }

    /**
     * Get the PluginClient.
     *
     * @return PluginClient
     */
    protected function getPluginClient()
    {
        if ($this->pluginClient !== null) {
            return $this->pluginClient;
        }

        $plugins = [
            new Plugin\ErrorPlugin(),
            new Plugin\AddHostPlugin($this->getApiEndpoint()),
            new PrependPathPlugin($this->getApiPath())
        ];

        // @todo set Locale plugin, Which automatically adds the locale query parameter.

        $this->pluginClient = new PluginClient(
            $this->httpClient,
            array_merge($plugins, $this->plugins)
        );

        return $this->pluginClient;
    }

    /**
     * {@inheritdoc}
     */
    public function executeRequest(RequestInterface $request)
    {
        $response = $this->getPluginClient()->sendRequest($request);

        return $this->parseResponse($response);
    }

    /**
     * Parse the response.
     *
     * @param ResponseInterface $response
     * @return array|object
     */
    protected function parseResponse(ResponseInterface $response)
    {
        $responseBody = json_decode(
            $response->getBody()->getContents()
        );

        $this->validateResponse($responseBody);

        return $responseBody->data;
    }

    /**
     * Validate the response.
     *
     * @param $response
     * @return bool
     * @throws InvalidRequestException
     */
    protected function validateResponse($response)
    {
        if (!property_exists($response, 'success') || $response->success !== true) {
            throw new InvalidRequestException($response->error_info, $response->error_code);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function createGatewayRequest()
    {
        return new GatewayRequest;
    }

    /**
     * {@inheritdoc}
     */
    public function createIssuerRequest()
    {
        return new IssuerRequest;
    }

    /**
     * {@inheritdoc}
     */
    public function createOrderRequest()
    {
        return new OrderRequest;
    }

    /**
     * {@inheritdoc}
     */
    public function createRequest($resource)
    {
        switch ($resource) {
            case 'gateways':
                return $this->createGatewayRequest();

            case 'issuers':
                return $this->createIssuerRequest();

            case 'orders':
                return $this->createOrderRequest();
        }

        throw new \InvalidArgumentException('Invalid command specified.');
    }
}
