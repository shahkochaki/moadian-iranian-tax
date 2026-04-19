<?php

namespace Shahkochaki\Moadian\Http;

use Shahkochaki\Moadian\Services\EncryptionService;
use Shahkochaki\Moadian\Services\SignatureService;
use Shahkochaki\Moadian\Traits\HasToken;

class RegistrationCodeInformation extends Request
{
    use HasToken;

    public function __construct(string $taxId)
    {
        parent::__construct();

        $this->path = 'taxpayer';
        $this->params['economicCode'] = $taxId;
    }

    public function prepare(SignatureService $signer, EncryptionService $encryptor)
    {
        $this->addToken($signer);
    }
}
