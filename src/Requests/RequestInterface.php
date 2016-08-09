<?php namespace Ntholenaar\MultiSafepayClient\Requests;

interface RequestInterface
{
    /**
     * Compile request.
     *
     * @return array
     */
    public function compileRequest();
}
