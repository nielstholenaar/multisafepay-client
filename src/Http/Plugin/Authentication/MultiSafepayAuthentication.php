<?php namespace Ntholenaar\MultiSafepayClient\Http\Plugin\Authentication;

use Http\Message\Authentication;
use Psr\Http\Message\RequestInterface;

final class MultiSafepayAuthentication implements Authentication
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @param $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(RequestInterface $request)
    {
        return $request->withHeader('api_key', $this->apiKey);
    }
}
