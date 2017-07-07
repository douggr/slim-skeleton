<?php
/**
 * https://dl2.tech - DL2 IT Services
 * Owlsome solutions. Owltstanding results.
 */

// namespace DL2\Slim\Controller\Config;

use DL2\Slim\Controller;
use Interop\Container\ContainerInterface;

// application env
define('APP_ENVIRONMENT', getenv('APP_ENVIRONMENT') ?: 'development');
define('APP_PRODUCTION', 'development' !== APP_ENVIRONMENT);

// define path to the application directory; no trailling slash
const APP_DIRNAME = __DIR__;

// define path to the `/public` directory; no trailling slash
const APP_WEBROOT = __DIR__ . '/../public';

//
// Configure database services.
//
(function () use ($app) {
    // $app->getContainer()->offsetSet(
    //     'database',
    //     function (ContainerInterface $container) {
    //         // configure any database service
    //     }
    // );
})();

//
// Configure error handlers.
//
(function () use ($app) {
    /**
     * Handle Slim errors.
     *
     * @param int $code
     * @param string $message
     * @param Interop\Container\ContainerInterface $container
     *
     * @return Closure The returned callable **MUST** return an instance
     *      of `Psr\Http\Message\ResponseInterface`
     */
    function handleSlimError($code, $message, ContainerInterface $container) // @codingStandardsIgnoreLine
    {
        return function () use ($code, $message, $container) {
            return $container->response->withStatus($code)->write($message);
        };
    }

    /** @var Interop\Container\ContainerInterface $container */
    $container = $app->getContainer();

    /*
     * Re-configure the `Not Found` handler.
     */
    $container->offsetSet(
        'notFoundHandler',
        function (ContainerInterface $container) {
            return handleSlimError(404, 'Not Found', $container);
        }
    );

    /*
     * Re-configure the `Not Allowed` handler.
     */
    $container->offsetSet(
        'notAllowedHandler',
        function (ContainerInterface $container) {
            return handleSlimError(405, 'Method Not Allowed', $container);
        }
    );

    /*
     * Re-configure the `PHP Error` handler.
     */
    $container->offsetSet(
        'phpErrorHandler',
        function (ContainerInterface $container) {
            return handleSlimError(500, 'Internal Server Error', $container);
        }
    );
})();

//
// Configure all known routes.
//
// @NOTE This is not a **rule**! Feel free to map the routes manually or
//      however you like it better. Remember to comment/delete the
//      function below.
(function () {
    /** @const string $cacheFile */
    $cacheFile = __DIR__ . '/../data/cache/49ca30dfe04467bbfc50236cc750a8b274048be2'; // @codingStandardsIgnoreLine

    if (APP_PRODUCTION && file_exists($cacheFile)) {
        return require $cacheFile;
    }

    /** @var string[] $cacheData */
    $cacheData = ['<?php use DL2\Slim\Controller;'];

    /** @var string $modulePaths */
    $modulePaths = glob(__DIR__ . '/modules/*');

    /**
     * The modules namespace as in your Controllers and defined
     * in `composer.autoload.psr-4`.
     *
     * @var string
     */
    $moduleNamespace = 'DL2\\Slim\\Module';

    while (list(, $module) = each($modulePaths)) {
        /** @var string $namespace */
        $namespace = basename($module);

        /** @var string[] $routes */
        $routes = [];

        // inside each module, we map every controller
        foreach (glob("{$module}/*.php") as $controller) {
            /** @var string $class */
            $class = substr(basename($controller), 0, -4);

            /* @var string $routes[] */
            $routes[] = "{$moduleNamespace}\\{$namespace}\\{$class}::class";
        }

        $cacheData[] = sprintf('Controller::map(%s);', implode(',', $routes));
    }

    file_put_contents($cacheFile, implode(PHP_EOL, $cacheData));

    return require $cacheFile;
})();
