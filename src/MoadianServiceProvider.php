<?php

namespace Shahkochaki\Moadian;

use Illuminate\Support\ServiceProvider;

class MoadianServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/moadian.php',
            'moadian'
        );

        $this->app->bind('Shahkochaki\Moadian\Moadian', function ($app) {

            $config = $app['config']['moadian'];

            $privateKeyPath = $config['private_key_path'] ?? storage_path('app/keys/private.pem');

            if (!file_exists($privateKeyPath) || !is_readable($privateKeyPath)) {
                throw new \RuntimeException("Moadian private key file not found or not readable: {$privateKeyPath}");
            }

            $privateKeyContents = file_get_contents($privateKeyPath);

            $privateKeyPassword = $config['private_key_password'] ?? null;

            if (!empty($privateKeyPassword)) {
                $privateKey = openssl_pkey_get_private($privateKeyContents, $privateKeyPassword);

                if ($privateKey === false) {
                    throw new \RuntimeException('Failed to load private key. Check the key file and password.');
                }
            } else {
                $privateKey = $privateKeyContents;
            }

            $certificatePath = $config['certificate_path'] ?? storage_path('app/keys/certificate.crt');

            if (!file_exists($certificatePath) || !is_readable($certificatePath)) {
                throw new \RuntimeException("Moadian certificate file not found or not readable: {$certificatePath}");
            }

            $certificate = file_get_contents($certificatePath);
            $certificate = str_replace(["\r\n", "\r"], '', $certificate);

            $baseUri = $config['base_uri'] ?? 'https://tp.tax.gov.ir/requestsmanager/api/v2/';

            return new Moadian($privateKey, $certificate, $baseUri);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/moadian.php' => config_path('moadian.php'),
        ], 'config');
    }
}
