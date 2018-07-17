<?php

namespace SQS\Pipeline\Client;

use Aws\Sqs\SqsClient;

/**
 * Class Client
 * @package SQS\Pipeline\Client
 */
class Client
{
    /**
     * @var SqsClient
     */
    protected $client;

    /**
     * @var mixed
     */
    private $id;

    /**
     * @var string
     */
    private $sqsUrl = 'https://sqs.us-east-1.amazonaws.com/%s/%s';

    /**
     * Client constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->client = new SqsClient([
            'credentials' => [
                'key' => $config['credentials']['key'],
                'secret' => $config['credentials']['secret'],
            ],
            'service' => 'sqs',
            'version' => '2012-11-05',
            'region' => $config['region'],
        ]);

        $this->id = $config['id'];
    }

    /**
     * @param string $queue
     * @return string
     */
    protected function makeQueueUrl(string $queue): string
    {
        return sprintf($this->sqsUrl, $this->id, $queue);
    }
}