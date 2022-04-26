<?php

namespace Sqwad\DirectFlow;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class DirectFlowClient
{
    private Client $client;
    private string $namespace;

    public function __construct(string $namespace, string $apiKey)
    {
        $this->client = new Client([
            'base_uri' => $_SERVER['DIRECT_FLOW_SERVER'] ?? 'https://flow.sqwad.io',
            'http_errors' => false,
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer ' . $apiKey,
            ]
        ]);
        $this->namespace = $namespace;
    }

    /**
     * Publish any data to websocket,
     * you can specify a channel in data to target any specific channel
     * @throws GuzzleException
     */
    public function publish($data): bool
    {
        $r = $this->client->post('/publish/' . $this->namespace, [
            RequestOptions::JSON => [
                'data' => $data
            ]
        ]);

        return $r->getStatusCode() === 201;
    }

    /**
     * Send directly to websocket, WARNING: “to”, “channel” and “_metadata” are reserved top level words !
     * @param $data
     * @return bool
     * @throws GuzzleException
     */
    public function rawPublish($data): bool
    {
        $r = $this->client->post('/publish/' . $this->namespace, [
            RequestOptions::JSON => $data
        ]);

        return $r->getStatusCode() === 201;
    }

    /**
     * @throws GuzzleException
     */
    public function sendTo(string $recipient, array $data): bool
    {
        return $this->publish([
            'to' => $recipient,
            'data' => $data
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function sendToChannel(string $channel, array $data): bool
    {
        return $this->publish([
            'channel' => $channel,
            'data' => $data
        ]);
    }

    /**
     * Return -1 if not found or not authorized
     * @throws GuzzleException
     */
    public function countConnections(): int
    {
        $r = $this->client->get('/connections/count/' . $this->namespace);

        if ($r->getStatusCode() > 300) {
            return -1;
        }

        return json_decode($r->getBody())->connections;
    }
}
