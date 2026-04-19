<?php

namespace Shahkochaki\Moadian\Http;

use Shahkochaki\Moadian\Services\EncryptionService;
use Shahkochaki\Moadian\Services\SignatureService;

abstract class Request
{
    public string $path;
    public string $method = 'get';

    protected array $headers;
    protected array $body;
    protected array $params;

    public function __construct()
    {
        $this->headers['accept'] = '*/*';
        $this->body   = [];
        $this->params = [];
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getParams()
    {
        return $this->params;
    }

    abstract function prepare(SignatureService $signer, EncryptionService $encryptor);
}
