<?php

namespace SQS\Pipeline\Test;

use Aws\Sqs\SqsClient;
use SQS\Pipeline\Message;
use PHPUnit\Framework\TestCase;
use SQS\Pipeline\Exceptions\SendMessageException;
use SQS\Pipeline\Exceptions\DeleteMessageException;
use SQS\Pipeline\Exceptions\ReceiveMessageException;

class MessageTest extends TestCase
{
    public function testMessageInstanceOf()
    {
        $message = $this->createMock(Message::class);

        $this->assertInstanceOf(Message::class, $message);
    }

    public function testMessageMethods()
    {
        $message = $this->createMock(Message::class);

        $this->assertTrue(method_exists($message, 'send'));
        $this->assertTrue(method_exists($message, 'receive'));
        $this->assertTrue(method_exists($message, 'delete'));
    }

    public function testMessageAttributes()
    {
        $message = new Message($this->configMock());

        $this->assertAttributeEquals(new SqsClient($this->configMock()), 'client', $message);
        $this->assertAttributeEquals('id', 'id', $message);
        $this->assertAttributeEquals('https://sqs.us-east-1.amazonaws.com/%s/%s', 'sqsUrl', $message);
    }

    public function testMessageSendException()
    {
        $this->expectException(SendMessageException::class);

        $message = new Message($this->configMock());
        $message->send('queue');
    }

    public function testMessageReceiveException()
    {
        $this->expectException(ReceiveMessageException::class);

        $message = new Message($this->configMock());
        $message->receive('queue');
    }

    public function testMessageDeleteException()
    {
        $this->expectException(DeleteMessageException::class);

        $message = new Message($this->configMock());
        $message->delete('queue', 'hash');
    }

    private function configMock(): array
    {
        return [
            'credentials' => [
                'key' => 'key',
                'secret' => 'secret',
            ],
            'service' => 'sqs',
            'version' => '2012-11-05',
            'region' => 'us-east-1',
            'id' => 'id',
        ];
    }
}