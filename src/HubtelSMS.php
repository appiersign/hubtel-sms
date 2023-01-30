<?php

namespace AppierSign\HubtelSMS;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

class HubtelSMS
{
    protected $guzzle;
    protected $senderID;
    protected $baseURL;

    public function __construct(string $username, string $password, string $senderID)
    {
        $options = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode("$username:$password")
            ]
        ];

        $this->guzzle = new GuzzleClient($options);
        $this->senderID = $senderID;
        $this->baseURL = 'https://sms.hubtel.com/v1/messages';
    }

    /**
     * @throws GuzzleException
     */
    public function get(string $endpoint)
    {
        $response = $this->guzzle->get("{$this->baseURL}$endpoint");
        return json_decode($response->getBody(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function post(string $endpoint, array $data = [])
    {
        $data['senderID'] = $this->senderID;
        $response = $this->guzzle->post("{$this->baseURL}$endpoint", ['form_params' => $data]);
        return json_decode($response->getBody(), true);
    }

    /**
     * @throws GuzzleException
     */
    public function send(string $phoneNumber, string $message)
    {
        return $this->post('/send', [
            'From' => $this->senderID,
            'To' => $phoneNumber,
            'Content' => $message
        ]);
    }
}