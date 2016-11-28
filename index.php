<?php

include('./vendor/autoload.php');

use Symfony\Component\HttpFoundation\Request;

# Show exception/error messages.
$app['debug'] = false;

$app = new Silex\Application();

list($_, $method, $path) = $argv;
$request = Request::create($path, $method);

$app['getConfigs'] = [
    \PRCountChecker\Config\ReportingTeamConfig::class
];

$app->get('/run', function () use ($app) {
    $configs = $app['getConfigs'];

    foreach ($configs as $configurationClass) {
        try {
            /** @var \PRCountChecker\Config $configurationObj */
            $configurationObj = new $configurationClass;
            $mainProgram = new \PRCountChecker\Main($configurationObj);
            $output = $mainProgram->checkAndNotifyOnLimitBreached();
            echo "[{$configurationClass}] Completed. Messages returned: " . $output . "\n";
        } catch (Exception $e) {
            echo "[{$configurationClass}] An error occurred: " . $e->getMessage() . "\n";
        }
    }

    return '';
});

$app->run($request);
