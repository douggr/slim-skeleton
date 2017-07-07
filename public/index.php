<?php
/**
 * https://dl2.tech - DL2 IT Services
 * Owlsome solutions. Owltstanding results.
 */

use DL2\Slim\Controller;

/*
 * Sets an internal error handler
 */
set_error_handler(
    /**
     * @param int $code
     * @param string $message
     * @param string $filename
     * @param int $line
     *
     * @internal
     */
    function ($code, $message, $filename, $line) {
        throw new ErrorException($message, $code, E_ERROR, $filename, $line);
    }
);

// set up default content-type
header('Content-Type: text/plain; charset=utf-8');

// QA
error_reporting(E_ALL);

// show all errors
ini_set('display_errors', true);

// composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

/*
 * Instantiate a Slim application by bootstraping our FronController.
 */
$app = Controller::bootstrap([
    'addContentLengthHeader'            => false,
    'determineRouteBeforeAppMiddleware' => false,
    'displayErrorDetails'               => false,
    'httpVersion'                       => '1.1',
    'outputBuffering'                   => 'append',
    'responseChunkSize'                 => 4096,
    'routerCacheFile'                   => false,
]);

/*
 * configure dependencies, middlewares, routes, etc.
 */
require_once __DIR__ . '/../src/bootstrap.php';

/*
 * Run our owlsome app.
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
