<?php

namespace App\Objects;

class PaymentGateway
{
    private string $login;
    private string $tranKey;
    private string $baseUrl;

    public function __construct()
    {
        $this->login = env('LOGIN_PAYMENT_GATEWAY');
        $this->tranKey = env('TRANKEY');
        $this->baseUrl = env('BASE_URL_PAYMENT_GATEWAY');
    }

    public function getPlaceToPay()
    {
        $this->placetopay = new \Dnetix\Redirection\PlacetoPay([
            'login' => $this->login, // Provided by PlacetoPay
            'tranKey' => $this->tranKey, // Provided by PlacetoPay
            'baseUrl' => $this->baseUrl,
            'timeout' => 10, // (optional) 15 by default
        ]);

        return $this->placetopay;
    }

}
