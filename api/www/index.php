<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Http\ResponseFormatter;

$configurator = App\Bootstrap::boot();
$container = $configurator->createContainer();
$application = $container->getByType(Nette\Application\Application::class);
try {
    $application->run();
} catch (Exception $e) {
    $message = $e instanceof \Nette\Database\ConnectionException ? \App\Http\Exceptions\Messages::CONNECTION_EXCEPTION : "";
    /**
     * @var ResponseFormatter $responseFormatter
     */
    $responseFormatter = $container->getService("responseFormatter");
    $formattedResponse = $responseFormatter->formatException(new Exception($message, 500), 500);
    http_response_code(500);
    die(\Nette\Utils\Json::encode($formattedResponse, \Nette\Utils\Json::PRETTY));
}