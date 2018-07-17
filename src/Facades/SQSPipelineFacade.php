<?php

namespace SQS\Pipeline\Facades;

use Illuminate\Support\Facades\Facade;

class SQSPipelineFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'sqs-php-pipeline';
    }
}