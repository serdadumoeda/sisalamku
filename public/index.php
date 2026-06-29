<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
try {
    /** @var Application $app */
    $app = require_once __DIR__.'/../bootstrap/app.php';

    // Register a custom Exception Handler to intercept and show the original error
    $app->singleton(
        \Illuminate\Contracts\Debug\ExceptionHandler::class,
        function ($app) {
            return new class($app) extends \Illuminate\Foundation\Exceptions\Handler {
                public function render($request, Throwable $e) {
                    header('HTTP/1.1 500 Internal Server Error');
                    echo "<h1>Original Exception Intercepted!</h1>";
                    echo "<h3>Exception Type:</h3>";
                    echo "<pre>" . htmlspecialchars(get_class($e)) . "</pre>";
                    echo "<h3>Error Message:</h3>";
                    echo "<pre style='background:#f8f9fa; padding:15px; border:1px solid #ced4da; overflow:auto;'>" . htmlspecialchars($e->getMessage()) . "</pre>";
                    echo "<h3>Stack Trace:</h3>";
                    echo "<pre style='background:#f8f9fa; padding:15px; border:1px solid #ced4da; overflow:auto;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
                    exit;
                }
            };
        }
    );

    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo "<h1>Laravel Boot Error (Plain Debug)</h1>";
    echo "<h3>Error Message:</h3>";
    echo "<pre style='background:#f8f9fa; padding:15px; border:1px solid #ced4da; overflow:auto;'>" . htmlspecialchars($e->getMessage()) . "</pre>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre style='background:#f8f9fa; padding:15px; border:1px solid #ced4da; overflow:auto;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
    exit;
}
