<?php

namespace App\Services;

use App\Models\MethodePaiement;
use Fedapay\Fedapay;
use Kkiapay\Kkiapay;

class PaymentService
{
    public function initializePayment($amount, $currency = 'XOF', $description = '', $type = 'kkiapay')
    {
        $methode = MethodePaiement::where('type', $type)->where('is_active', true)->first();

        if (!$methode) throw new \Exception('Méthode de paiement non trouvée ou inactive');

        return $type === 'fedapay'
            ? $this->initializeFedaPay($amount, $currency, $description, $methode)
            : $this->initializeKkiaPay($amount, $currency, $description, $methode);
    }

    protected function initializeFedaPay($amount, $currency, $description, $methode)
    {
        Fedapay::setApiKey($methode->secret_key);

        $transaction = \Fedapay\Transaction::create([
            'amount' => $amount,
            'currency' => ['iso' => $currency],
            'description' => $description,
            'callback_url' => route('payment.callback'),
            'customer' => [
                'email' => auth()->user()->email ?? '',
                'firstname' => auth()->user()->name ?? ''
            ]
        ]);

        return [
            'payment_url' => $transaction->payment_url,
            'transaction_id' => $transaction->id
        ];
    }

    protected function initializeKkiaPay($amount, $currency, $description, $methode)
    {
        $kkiapay = new Kkiapay([
            'public_key' => $methode->public_key,
            'private_key' => $methode->secret_key,
            'secret' => $methode->secret_key,
            'sandbox' => config('app.env') !== 'production'
        ]);

        $transaction = $kkiapay->createTransaction([
            'amount' => $amount,
            'currency' => $currency,
            'description' => $description,
            'callback_url' => route('payment.callback'),
            'customer' => [
                'email' => auth()->user()->email ?? '',
                'name' => auth()->user()->name ?? '',
            ]
        ]);

        return [
            'payment_url' => $transaction->payment_url,
            'transaction_id' => $transaction->id
        ];
    }

    public function verifyTransaction($transactionId)
    {
        // TODO: Ajoute les appels aux API FedaPay ou Kkiapay ici
        return ['status' => 'SUCCESS'];
    }
}


