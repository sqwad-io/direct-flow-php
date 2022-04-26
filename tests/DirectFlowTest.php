<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Sqwad\DirectFlow\DirectFlowClient;
use Throwable;

final class DirectFlowTest extends TestCase
{
    private DirectFlowClient $client;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->client = new DirectFlowClient('d773cbae-a469-4bd0-93de-02cd3f76a987', 'd0e41aff-6a90-4d7a-9eee-db1998353192');

        parent::__construct($name, $data, $dataName);
    }

    public function testCountConnections()
    {
        $this->assertNotEquals(-1, $this->client->countConnections());
    }

    public function testMessage()
    {
        try {
            $this->assertTrue($this->client->publish([
                'hello' => 'world',
            ]));
        } catch (Throwable $e) {
            $this->fail();
        }
    }

    public function testRawMessage()
    {
        try {
            $this->assertTrue($this->client->rawPublish([
                'hello' => 'world',
            ]));
        } catch (Throwable $e) {
            $this->fail();
        }
    }

    public function testChannel()
    {
        try {
            $this->assertTrue($this->client->sendToChannel('my-channel', [
                'hello' => 'world',
            ]));
        } catch (Throwable $e) {
            $this->fail();
        }
    }

    public function testTo()
    {
        try {
            $this->assertTrue($this->client->sendTo('my-uuid', [
                'hello' => 'world',
            ]));
        } catch (Throwable $e) {
            $this->fail();
        }
    }
}
