<?php namespace Ntholenaar\MultiSafepayClient;

use Http\Client\Common\HttpMethodsClient;
use Http\Client\Common\Plugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\MessageFactory;
use Http\Message\UriFactory;
use Ntholenaar\MultiSafepayClient\Http\Plugin\Authentication;
use Ntholenaar\MultiSafepayClient\Http\Plugin\PrependPathPlugin;

class Client implements ClientInterface
{
    /**
     * @var HttpMethodsClient
     */
    private $methodsClient;

    /**
     * @var MessageFactory
     */
    private $messageFactory;

    /**
     * @var string
     */
    private $environment = 'production';

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var UriFactory
     */
    private $uriFactory;

    /**
     * @var array
     */
    private $plugins = array();

    /**
     * @param HttpClient|null $httpClient
     * @param MessageFactory|null $messageFactory
     * @param UriFactory|null $uriFactory
     */
    public function __construct(
        HttpClient $httpClient = null,
        MessageFactory $messageFactory = null,
        UriFactory $uriFactory = null
    ) {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();

        $this->messageFactory = $messageFactory ?: MessageFactoryDiscovery::find();

        $this->uriFactory = $uriFactory ?: UriFactoryDiscovery::find();
    }

    /**
     * {@inheritdoc}
     */
    public function setApiKey($apiKey)
    {
        $this->addPlugin(
            new Plugin\AuthenticationPlugin(
                new Authentication($apiKey)
            )
        );

        return $this;
    }

    /**
     * Get the API endpoint.
     *
     * @return string
     */
    protected function getApiEndpoint()
    {
        if ($this->environment === 'test') {
            return 'https://testapi.multisafepay.com';
        }

        return 'https://api.multisafepay.com';
    }

    /**
     * {@inheritdoc}
     */
    public function environment($environment)
    {
        if ($environment !== 'production' && $environment !== 'test') {
            throw new \InvalidArgumentException('Invalid environment specified.');
        }

        $this->environment = $environment;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function api($name)
    {
        switch ($name) {
            case 'orders':
                return new Api\Orders($this);

            case 'gateways':
                return new Api\Gateways($this);

            case 'issuers':
                return new Api\Issuers($this);
        }

        throw new \InvalidArgumentException('Invalid api specified.');
    }

    /**
     * {@inheritdoc}
     */
    public function addPlugin(Plugin $plugin)
    {
        $this->plugins[] = $plugin;

        $this->invalidHttpClient();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpClient()
    {
        if ($this->methodsClient !== null) {
            return $this->methodsClient;
        }

        $plugins = array_merge(
            $this->plugins,
            array(
                new Plugin\ErrorPlugin(),
                new Plugin\AddHostPlugin($this->uriFactory->createUri($this->getApiEndpoint())),
                new PrependPathPlugin('/v1/json')
            )
        );

        $pluginClient = new PluginClient($this->httpClient, $plugins);

        $this->methodsClient = new HttpMethodsClient($pluginClient, $this->messageFactory);

        return $this->methodsClient;
    }

    /**
     * Invalidate the http client.
     *
     * @return $this
     */
    protected function invalidHttpClient()
    {
        $this->methodsClient = null;

        return $this;
    }
}
