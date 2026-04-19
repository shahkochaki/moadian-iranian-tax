<?php

namespace Shahkochaki\Moadian\Http;

use Shahkochaki\Moadian\Services\EncryptionService;
use Shahkochaki\Moadian\Services\SignatureService;
use Shahkochaki\Moadian\Traits\HasToken;

class FiscalInfo extends Request
{
    use HasToken;

    public function __construct()
    {
        parent::__construct();

        $this->path = 'fiscal-information';
        $this->params['memoryId'] = config('moadian.username');
    }

    public function prepare(SignatureService $signer, EncryptionService $encryptor)
    {
        $this->addToken($signer);
    }
}
