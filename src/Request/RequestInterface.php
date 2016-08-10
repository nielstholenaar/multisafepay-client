<?php namespace Ntholenaar\MultiSafepayClient\Request;

use Ntholenaar\MultiSafepayClient\Exception\InvalidRequestException;
use Ntholenaar\MultiSafepayClient\Response\ResponseInterface;

interface RequestInterface
{
    /**
     * Set the environment.
     *
     * @param $environment
     * @throws \InvalidArgumentException when an invalid environment is specified.
     * @return $this
     */
    public function setEnvironment($environment);

    /**
     * Get the environment.
     *
     * @return string
     */
    public function getEnvironment();

    /**
     * Get all query parameters.
     *
     * @return array
     */
    public function getQueryParameters();

    /**
     * Compile the PSR-7 HTTP Request.
     *
     * @return \Psr\Http\Message\RequestInterface
     * @throws InvalidRequestException
     */
    public function compileHttpRequest();

    /**
     * Validate the request.
     *
     * @return bool
     */
    public function validate();
}
