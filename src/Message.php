<?php

namespace SQS\Pipeline;

use Aws\ResultInterface;
use Aws\Exception\AwsException;
use SQS\Pipeline\Client\Client;
use SQS\Pipeline\Exceptions\SendMessageException;
use SQS\Pipeline\Exceptions\DeleteMessageException;
use SQS\Pipeline\Exceptions\ReceiveMessageException;

/**
 * Class Message
 * @package SQS\Pipeline
 */
class Message extends Client
{
    /**
     * Message constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        parent::__construct($config);
    }

    /**
     * @param string $queue
     * @param array $messageBody
     * @param array $messageAttributes
     * @param int $delaySeconds
     * @return ResultInterface
     * @throws SendMessageException
     */
    public function send(
        string $queue,
        array $messageBody = [],
        array $messageAttributes = [],
        int $delaySeconds = 5
    ): ResultInterface {
        try {
            $params = [
                'DelaySeconds' => $delaySeconds,
                'MessageAttributes' => $messageAttributes,
                'MessageBody' => json_encode($messageBody),
                'QueueUrl' => $this->makeQueueUrl($queue),
            ];

            return $this->client->sendMessage($params);
        } catch (AwsException $exception) {
            throw new SendMessageException($exception->getMessage(), $exception);
        }
    }

    /**
     * @param string $queue
     * @return mixed
     * @throws ReceiveMessageException
     */
    public function receive(string $queue): array
    {
        try {
            $result = $this->client->receiveMessage([
                'QueueUrl' => $this->makeQueueUrl($queue),
            ]);

            $messages = $result->get('Messages') ?? [];

            return array_map(function ($message) {
                $message['Body'] = json_decode($message['Body']);
                return $message;
            }, $messages);
        } catch (AwsException $exception) {
            throw new ReceiveMessageException($exception->getMessage(), $exception);
        }
    }

    /**
     * @param string $queue
     * @param string $receiptHandle
     * @return ResultInterface
     * @throws DeleteMessageException
     */
    public function delete(string $queue, string $receiptHandle): ResultInterface
    {
        try {
            return $this->client->deleteMessage([
                'QueueUrl' => $this->makeQueueUrl($queue),
                'ReceiptHandle' => $receiptHandle,
            ]);
        } catch (AwsException $exception) {
            throw new DeleteMessageException($exception->getMessage(), $exception);
        }
    }
}