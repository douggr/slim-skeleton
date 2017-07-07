<?php
/**
 * https://dl2.tech - DL2 IT Services
 * Owlsome solutions. Owltstanding results.
 */

namespace DL2\Slim\Skeleton\Tests;

use DL2\Slim\Module\Home\Index as IndexController;

class IndexTest extends TestCase
{
    /**
     * @covers \DL2\Slim\Module\Home\Index::getAction
     */
    public function testGetAction()
    {
        $response = $this->runApp('get', '/10');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
            (string) $response->getBody(), IndexController::QUOTES[10]
        );

        $response = $this->runApp('get', '/1000');

        $this->assertEquals(404, $response->getStatusCode());
    }

    /**
     * @covers \DL2\Slim\Module\Home\Index::indexAction
     */
    public function testIndexAction()
    {
        $response = $this->runApp('get', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(
            in_array($response->getBody(), IndexController::QUOTES)
        );
    }
}
