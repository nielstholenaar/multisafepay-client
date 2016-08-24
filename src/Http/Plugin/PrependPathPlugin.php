<?php namespace Ntholenaar\MultiSafepayClient\Http\Plugin;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

final class PrependPathPlugin implements Plugin
{
    /**
     * @var UriInterface
     */
    private $path;

    /**
     * @param UriInterface $path
     */
    public function __construct(UriInterface $path)
    {
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        $uri = $request->getUri();

        $request = $request->withUri(
            $uri->withPath($this->path . $uri->getPath())
        );

        return $next($request);
    }
}
