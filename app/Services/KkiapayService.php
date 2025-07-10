<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KkiapayService
{
    protected $publicKey;
    protected $privateKey;
    protected $secret;
    protected $sandbox;

    public function __construct()
    {
        $this->publicKey = config('services.kkiapay.public_key');
        $this->privateKey = config('services.kkiapay.private_key');
        $this->secret = config('services.kkiapay.secret');
        $this->sandbox = config('services.kkiapay.sandbox', true);
    }

    public function initializePayment($amount, $customer, $description = null)
    {
        $baseUrl = $this->sandbox ? 'https://api-sandbox.kkiapay.com' : 'https://api.kkiapay.com';
        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->privateKey
        ])->post($baseUrl . '/api/v1/transactions/initialize', [
            'amount' => $amount,
            'customer' => $customer,
            'description' => $description,
            'currency' => 'XOF',
            'callback_url' => route('kkiapay.callback'),
            'return_url' => route('kkiapay.return')
        ]);

        return $response->json();
    }

    public function verifyTransaction($transactionId)
    {
        $baseUrl = $this->sandbox ? 'https://api-sandbox.kkiapay.com' : 'https://api.kkiapay.com';
        
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->privateKey
        ])->get($baseUrl . '/api/v1/transactions/' . $transactionId);

        return $response->json();
    }
} 