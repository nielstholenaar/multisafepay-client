<?php namespace Ntholenaar\MultiSafepayClient\Http\Plugin;

use Http\Client\Common\Plugin;
use Psr\Http\Message\RequestInterface;

final class PrependPathPlugin implements Plugin
{
    /**
     * @var string
     */
    private $path;

    /**
     * @param $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     */
    public function handleRequest(RequestInterface $request, callable $next, callable $first)
    {
        $path = $this->path . $request->getUri()->getPath();

        $request = $request->withUri(
            $request->getUri()->withPath($path)
        );

        return $next($request);
    }
}
