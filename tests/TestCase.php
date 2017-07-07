<?php
/**
 * https://dl2.tech - DL2 IT Services
 * Owlsome solutions. Owltstanding results.
 */

namespace DL2\Slim\Skeleton\Tests;

use DL2\Slim\Controller;
use PHPUnit\Framework;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;

class TestCase extends Framework\TestCase
{
    /**
     * Process the application given a request method and URI.
     *
     * @param string $method the request method (e.g. GET, POST, etc.)
     * @param string $uri the request URI
     * @param array|object|null $body the request data
     *
     * @return Slim\Http\Response
     *
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function runApp($method, $uri = '', $body = null, array $headers = []) // @codingStandardsIgnoreLine
    {
        // Create a mock environment for testing with
        $environment = Environment::mock([
            'REQUEST_METHOD' => strtoupper($method),
            'REQUEST_URI'    => $uri,
        ]);

        // Set up a request object based on the environment
        $request = Request::createFromEnvironment($environment);

        // add custom headers
        foreach ($headers as $header => $value) {
            $request = $request->withHeader($header, $value);
        }

        // Add request data, if it exists
        if ($body) {
            $request = $request->withParsedBody($body);
        }

        // Set up a response object
        $response = new Response();

        // Instantiate the application
        $app = Controller::bootstrap();

        /*
         * configure dependencies, middlewares, routes, etc.
         */
        require_once __DIR__ . '/../src/bootstrap.php';

        // Process the application
        $response = $app->process($request, $response);

        // Return the response
        return $response;
    }
}
