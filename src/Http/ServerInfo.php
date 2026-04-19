<?php

namespace Shahkochaki\Moadian\Http;

use Shahkochaki\Moadian\Services\EncryptionService;
use Shahkochaki\Moadian\Services\SignatureService;
use Shahkochaki\Moadian\Traits\HasToken;

class ServerInfo extends Request
{
    use HasToken;

    public function __construct()
    {
        parent::__construct();

        $this->path = 'server-information';
    }

    public function prepare(SignatureService $signer, EncryptionService $encryptor)
    {
        $this->addToken($signer);
    }
}
