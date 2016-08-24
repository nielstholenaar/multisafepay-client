<?php namespace Ntholenaar\MultiSafepayClient\Request;

use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\UriFactoryDiscovery;
use Http\Message\MessageFactory;
use Http\Message\UriFactory;
use Psr\Http\Message\UriInterface;

class Request implements RequestInterface
{
    /**
     * @var MessageFactory
     */
    protected $messageFactory;

    /**
     * @var UriFactory
     */
    protected $uriFactory;

    /**
     * @var string
     */
    protected $baseUrl = '';

    /**
     * @param MessageFactory|null $messageFactory
     * @param UriFactory|null $uriFactory
     */
    public function __construct(MessageFactory $messageFactory = null, UriFactory $uriFactory = null)
    {
        if (is_null($messageFactory)) {
            $messageFactory = MessageFactoryDiscovery::find();
        }

        if (is_null($uriFactory)) {
            $uriFactory = UriFactoryDiscovery::find();
        }

        $this->setUriFactory($uriFactory);

        $this->setMessageFactory($messageFactory);
    }

    /**
     * Get the MessageFactory.
     *
     * @return MessageFactory
     */
    protected function getMessageFactory()
    {
        return $this->messageFactory;
    }

    /**
     * Set the MessageFactory.
     *
     * @param MessageFactory $messageFactory
     * @return $this
     */
    protected function setMessageFactory(MessageFactory $messageFactory)
    {
        $this->messageFactory = $messageFactory;

        return $this;
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
     * Get the base url.
     *
     * @return string
     */
    protected function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Set the base url.
     *
     * @param $baseUrl
     * @return $this
     */
    protected function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * Create GET request.
     *
     *
     * @param UriInterface $uri
     * @param array $query
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function get(UriInterface $uri, array $query = array())
    {
        $uri = $uri->withQuery(http_build_query($query));

        return $this->messageFactory->createRequest('GET', $uri);
    }

    /**
     * Create POST request.
     *
     * @param UriInterface $uri
     * @param array $query
     * @param array $body
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function post(UriInterface $uri, array $query = array(), array $body = array())
    {
        $uri = $uri->withQuery(http_build_query($query));

        $body = json_encode($body);

        return $this->messageFactory->createRequest('POST', $uri, array(), $body);
    }
}
