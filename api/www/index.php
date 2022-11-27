<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Http\Exceptions\HttpClientException;
use App\Http\ResponseFormatter;
use App\Http\Responses\JsonResponse;
use Nette\Http\IResponse;

$configurator = App\Bootstrap::boot();
$container = $configurator->createContainer();
$application = $container->getByType(Nette\Application\Application::class);
try {
    $application->run();
} catch (Exception $e) {
    if($configurator->isDebugMode()) {
        throw $e;
    } else {
        /**
         * @var ResponseFormatter $responseFormatter
         */
        $responseFormatter = $container->getService("responseFormatter");
        if(in_array($e->getCode(), array_keys(IResponse::REASON_PHRASES))) {
            $httpCode = $e->getCode();
            $message = IResponse::REASON_PHRASES[$httpCode];
        } else {
            $httpCode = 500;
            $message = "";
        }
        $formattedResponse = $responseFormatter->formatException(new HttpClientException($message, new $e, (int)$e->getCode()), $httpCode);
        $jsonResponse = new JsonResponse($formattedResponse, $httpCode, true, null);
        http_response_code($httpCode);
        header("Content-Type: application/json; charset=UTF-8");
        echo $jsonResponse;
        die();
    }
}