<?php namespace Ntholenaar\MultiSafepayClient\Http;

use Http\Client\Common\Plugin\AuthenticationPlugin;
use Http\Client\Common\Plugin\ErrorPlugin;
use Http\Client\Common\PluginClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Ntholenaar\MultiSafepayClient\Http\Authentication\MultiSafepayAuthentication;

class HttpClientFactory
{
    /**
     *
     *
     * @param $apiKey
     * @param HttpClient|null $client
     * @return HttpClient
     */
    public static function create($apiKey, HttpClient $client = null)
    {
        if (is_null($client)) {
            $client = HttpClientDiscovery::find();
        }

        return new PluginClient($client, [
            new ErrorPlugin(),
            new AuthenticationPlugin(
                new MultiSafepayAuthentication($apiKey)
            )
        ]);
    }
}
