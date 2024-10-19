<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Aquí puedes registrar servicios, si es necesario
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Configura el token de acceso
        MercadoPagoConfig::setAccessToken(config('mercadopago.access_token'));

        // (Opcional) Configura el entorno si quieres probar localmente
        // MercadoPagoConfig::setRuntimeEnviroment(MercadoPagoConfig::LOCAL);
    }
}
