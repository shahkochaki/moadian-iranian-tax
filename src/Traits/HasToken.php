<?php

namespace Shahkochaki\Moadian\Traits;

use Shahkochaki\Moadian\Facades\Moadian;
use Shahkochaki\Moadian\Services\SignatureService;

trait HasToken
{
    /**
     * Create authorization token
     * 
     * @param SignatureService $signer
     * 
     */
    public function addToken(SignatureService $signer)
    {
        $payload = [
            'nonce'    => Moadian::getNonce(),
            'clientId' => config('moadian.username')
        ];

        $token = $signer->sign($payload);

        $auth = 'Bearer ' . $token;
        $this->headers['authorization'] = $auth;
    }
}
