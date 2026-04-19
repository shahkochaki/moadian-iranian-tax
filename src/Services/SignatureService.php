<?php

namespace Shahkochaki\Moadian\Services;

use Carbon\Carbon;
use Firebase\JWT\JWT;

class SignatureService
{
    /** @var \OpenSSLAsymmetricKey|resource|string */
    private $privateKey;
    private string $x5c;

    /**
     * @param \OpenSSLAsymmetricKey|resource|string $privateKey PEM string or key loaded via openssl_pkey_get_private()
     */
    public function __construct($privateKey, string $x5c)
    {
        $this->privateKey = $privateKey;
        $this->x5c = $x5c;
    }

    /**
     * Converts and signs a PHP array to JWS string
     */
    public function sign(array $payload, array $headers = [])
    {
        if (empty($headers)) {
            $headers = [
                'alg'  => 'RS256',
                'x5c'  => [$this->x5c],
                'sigT' => Carbon::now()->toIso8601ZuluString(),
                'typ'  => 'jose',
                'crit' => ['sigT'],
                'cty'  => 'text/plain'
            ];
        }

        $segments = [];
        $segments[] = JWT::urlsafeB64Encode(JWT::jsonEncode($headers));
        $segments[] = JWT::urlsafeB64Encode(JWT::jsonEncode($payload));

        $signingInput = implode('.', $segments);
        $signature    = JWT::sign($signingInput, $this->privateKey, $headers['alg']);
        $segments[]   = JWT::urlsafeB64Encode($signature);

        return implode('.', $segments);
    }
}
