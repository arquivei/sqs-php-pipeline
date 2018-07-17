<?php

namespace SQS\Pipeline\Providers;

use SQS\Pipeline\Message;
use Illuminate\Support\ServiceProvider;

/**
 * Class SQSPipelineServiceProvider
 * @package SQS\Pipeline\Providers
 */
class SQSPipelineServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/sqs-php-pipeline.php' => config_path('sqs-php-pipeline.php')
        ]);

        $this->app->bind('sqs-php-pipeline', function (){
            return new Message(config('sqs-php-pipeline'));
        });
    }
}