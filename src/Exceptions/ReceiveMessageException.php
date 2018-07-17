<?php

namespace SQS\Pipeline\Exceptions;

use Throwable;

/**
 * Class ReceiveMessageException
 * @package SQS\Pipeline\Exceptions
 */
class ReceiveMessageException extends \Exception
{
    /**
     * ReceiveMessageException constructor.
     * @param string $message
     * @param Throwable|null $previous
     * @param int $code
     */
    public function __construct(
        string $message = 'Error receiving AWS SQS message.',
        Throwable $previous = null,
        int $code = 0
    ) {
        parent::__construct($message, $code, $previous);
    }
}