<?php 
namespace App\Services;

use GuzzleHttp\Client;

class MidtransService
{
    protected $client;
    protected $serverKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->serverKey = env('MIDTRANS_SERVER_KEY');
        $this->baseUrl = env('MIDTRANS_ENVIRONMENT') === 'production'
            ? 'https://api.midtrans.com/v2'
            : 'https://api.sandbox.midtrans.com/v2';
        $this->client = new Client();
    }

    public function cancelTransaction($orderId)
    {
        $response = $this->client->post("{$this->baseUrl}/{$orderId}/cancel", [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':'),
                'Content-Type' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
