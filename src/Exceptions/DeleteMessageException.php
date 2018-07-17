<?php

namespace SQS\Pipeline\Exceptions;

use Throwable;

/**
 * Class DeleteMessageException
 * @package SQS\Pipeline\Exceptions
 */
class DeleteMessageException extends \Exception
{
    /**
     * DeleteMessageException constructor.
     * @param string $message
     * @param Throwable|null $previous
     * @param int $code
     */
    public function __construct(
        string $message = 'Error from delete AWS SQS message.',
        Throwable $previous = null,
        int $code = 0
    ) {
        parent::__construct($message, $code, $previous);
    }
}