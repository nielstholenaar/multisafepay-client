<?php namespace Ntholenaar\MultiSafepayClient\Request;

use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\MessageFactory;
use Ntholenaar\MultiSafepayClient\Exception\InvalidRequestException;

abstract class AbstractRequest implements RequestInterface
{
    /**
     * Endpoint of the MultiSafepay test API environment.
     *
     * @var string
     */
    protected $testApiEndpoint = 'https://testapi.multisafepay.com/v1/json/';

    /**
     * Endpoint of the MultiSafepay live API environment.
     *
     * @var string
     */
    protected $apiEndpoint = 'https://api.multisafepay.com/v1/json/';

    /**
     * @var string
     */
    protected $environment;

    /**
     * Query parameters.
     *
     * @var array
     */
    protected $queryParameters = array();

    /**
     * Request body.
     *
     * @var array
     */
    protected $requestBody = array();

    /**
     * HTTP Request Method.
     *
     * @var string
     */
    protected $httpMethod = 'GET';

    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * @var string
     */
    protected $path;

    /**
     * @param $environment
     * @param array $parameters
     * @param MessageFactory|null $messageFactory
     */
    public function __construct(
        $environment,
        array $parameters = array(),
        MessageFactory $messageFactory = null
    ) {
        $this->parseParameters($parameters);

        if (!$messageFactory) {
            $messageFactory = MessageFactoryDiscovery::find();
        }

        $this->setMessageFactory($messageFactory);

        $this->setEnvironment($environment);
    }

    /**
     * {@inheritdoc}
     */
    public function setEnvironment($environment)
    {
        if ($environment !== 'live' && $environment !== 'test') {
            throw new \InvalidArgumentException('Invalid environment specified.');
        }

        $this->environment = $environment;

        return $this;
    }

    /**
     * Get the locale.
     *
     * @return string
     */
    protected function getLocale()
    {
        return $this->getQueryParameter('locale');
    }

    /**
     * Set the locale.
     *
     * @param string $locale
     * @return $this
     */
    protected function setLocale($locale)
    {
        $this->setQueryParameter('locale', $locale);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * Set the message factory.
     *
     * @param MessageFactory $messageFactory
     * @return $this
     */
    private function setMessageFactory(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;

        return $this;
    }

    /**
     * Get the MessageFactory.
     *
     * @return MessageFactory
     */
    private function getMessageFactory()
    {
        return $this->messageFactory;
    }

    /**
     * Get an specific query parameter by it's key.
     *
     * @param $key
     * @return null|mixed
     */
    protected function getQueryParameter($key)
    {
        if (!array_key_exists($key, $this->queryParameters)) {
            return null;
        }

        return $this->queryParameters[$key];
    }

    /**
     * Set an query parameter.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    protected function setQueryParameter($key, $value)
    {
        $this->queryParameters[$key] = $value;

        return $this;
    }

    /**
     * Get the request body.
     *
     * @return array
     */
    protected function getRequestBody()
    {
        return $this->requestBody;
    }

    /**
     * Set the request body.
     *
     * @param array $requestBody
     * @return $this
     */
    protected function setRequestBody(array $requestBody)
    {
        $this->requestBody = $requestBody;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getQueryParameters()
    {
        return $this->queryParameters;
    }

    /**
     * Parse multiple parameters.
     *
     * When there is no setter for the given
     * parameter, the parameter will be ignored.
     *
     * @param $parameters
     */
    private function parseParameters($parameters)
    {
        foreach ($parameters as $key => $value) {
            $methodName = 'set' . ucfirst($key);

            if (!method_exists($this, $methodName)) {
                continue;
            }

            $this->{$methodName}($value);
        }
    }

    /**
     * Get the HTTP Request Method.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Get the api endpoint.
     *
     * @return string
     */
    protected function getApiEndpoint()
    {
        if ($this->getEnvironment() === 'live') {
            return $this->apiEndpoint;
        }

        return $this->testApiEndpoint;
    }

    /**
     * Get the path.
     *
     * @return string
     */
    protected function getPath()
    {
        return $this->path;
    }

    /**
     * Compile the uri.
     *
     * @return \Psr\Http\Message\UriInterface
     */
    private function compileUri()
    {
        $uriFactory = UriFactoryDiscovery::find();

        $url = $this->getApiEndpoint() . $this->getPath();

        if (count($this->getQueryParameters()) > 0) {
            $url .= '?' . http_build_query($this->getQueryParameters());
        }

        return $uriFactory->createUri($url);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function validate();

    /**
     * {@inheritdoc}
     */
    public function compileHttpRequest()
    {
        if (!$this->validate()) {
            throw new InvalidRequestException('One or more required parameters are not set.');
        }

        $messageFactory = $this->getMessageFactory();

        return $messageFactory->createRequest(
            $this->getHttpMethod(),
            $this->compileUri(),
            array(),
            http_build_query($this->getRequestBody())
        );
    }
}
