# SQS PHP Pipeline

## Install

    composer require arquivei/sqs-php-pipeline
    
### If usage Laravel

Add `sqs-php-pipeline.php` in your `config` and configure your AWS credentials. 

#### Laravel <= 5.4

Add the provider and facade in your `config/app.php`

~~~
'providers' => [
    SQS\Pipeline\Providers\SQSPipelineServiceProvider::class,
]

'aliases' => [
    'SQSPipeline' => SQS\Pipeline\Facades\SQSPipelineFacade::class,
]
~~~

#### Laravel >= 5.5

Add only facade in your `config/app.php`

~~~
'aliases' => [
    'SQSPipeline' => SQS\Pipeline\Facades\SQSPipelineFacade::class,
]
~~~

After, run `php artisan package:discover` to publish extras providers.

## Important

- In `SqsClient config` the `service` and `version` is hardcoded because the AWS methods are modified between versions.

## Usage

~~~
$message = new SQS\Pipeline\Message(array $config);

// $queue (queue name)
// $messageBody (content of message)
// $messageAttributes (message attributes)
// $delaySeconds (delay to publish message)
// @return Aws\Result
$message->send($queue, $messageBody, $messageAttributes, $delaySeconds);

// $queue (queue name)
// @return array
$message->receive($queue)

// $queue (queue name)
// @return Aws\Result
$message->delete($queue)
~~~
