# Sqwad DirectFlow Client PHP library

Instant bidirectional interactions made easy !

Guzzle is needed and included, but you can pass a custom client at construct time.

## Installation

```shell
composer require sqwad/direct-flow
```

## Usage

Note: Replace with your API keys

### Broadcast to any client

```injectablephp
use Sqwad\DirectFlow\DirectFlowClient

$client = new DirectFlowClient('d773cbae-a469-4bd0-93de-02cd3f76a987', 'd0e41aff-6a90-4d7a-9eee-db1998353192');
$client->publish([
    'foo' => 'bar',
]);
```

### Broadcast to a specific channel

You can broadcast a message to a specific channel, for example a user UUID, a trading topic, ...

```injectablephp
use Sqwad\DirectFlow\DirectFlowClient

$client = new DirectFlowClient('d773cbae-a469-4bd0-93de-02cd3f76a987', 'd0e41aff-6a90-4d7a-9eee-db1998353192');
$client->publish([
    'channel' => 'my-channel',
    'foo' => 'bar',
]);
```

### Send to recipient

You can send message or data to a specific recipient, to do so, the `to` field need to be set with websocket id.


```injectablephp
use Sqwad\DirectFlow\DirectFlowClient

$client = new DirectFlowClient('d773cbae-a469-4bd0-93de-02cd3f76a987', 'd0e41aff-6a90-4d7a-9eee-db1998353192');
$client->publish([
    'to' => 'recipient-id',
    'foo' => 'bar',
]);
```
