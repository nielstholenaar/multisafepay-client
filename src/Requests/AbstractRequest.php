<?php namespace Ntholenaar\MultiSafepayClient;

use Ntholenaar\MultiSafepayClient\Requests\RequestInterface;

abstract class AbstractRequest implements RequestInterface
{
    /**
     * Request parameters.
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
     * Get an specific query parameter by it's key.
     *
     * @param $key
     * @return null|mixed
     */
    protected function getQueryParameter($key)
    {
        if (! array_key_exists($key, $this->queryParameters)) {
            return null;
        }

        return $this->queryParameters[$key];
    }

    /**
     * Set an query parameter.
     *
     * @param $key
     * @param $value
     */
    protected function setQueryParameter($key, $value)
    {
        $this->queryParameters[$key] = $value;
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
     * Parse an given parameter array.
     * Only the allowed parameters are stored.
     *
     * @param $parameters
     */
    protected function parseParameters($parameters)
    {
        foreach ($parameters as $key => $value) {
            $methodName = 'set' . ucfirst($key);

            if (! method_exists($this, $methodName)) {
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
     * Validate the given parameters.
     *
     * @return bool
     */
    abstract protected function validateParameters();

    /**
     * Get the url.
     *
     * @return string
     */
    abstract protected function getUrl();

    /**
     * {@inheritdoc}
     */
    public function compileRequest()
    {
        if (! $this->validateParameters()) {
            throw new \Exception('Invalid request. One or more required parameters are not set.');
        }

        $body   = $this->getHttpMethod() !== 'GET' ?:$this->getRequestBody();
        $method = $this->getHttpMethod();
        $url    = $this->getUrl();

        return compact('body', 'method', 'url');
    }
}
