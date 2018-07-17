<?php

namespace SQS\Pipeline\Exceptions;

use Throwable;

/**
 * Class SendMessageException
 * @package SQS\Pipeline\Exceptions
 */
class SendMessageException extends \Exception
{
    /**
     * SendMessageException constructor.
     * @param string $message
     * @param Throwable|null $previous
     * @param int $code
     */
    public function __construct(
        string $message = 'Error from send AWS SQS message.',
        Throwable $previous = null,
        int $code = 0
    ) {
        parent::__construct($message, $code, $previous);
    }
}