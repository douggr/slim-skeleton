<?php
/**
 * https://dl2.tech - DL2 IT Services
 * Owlsome solutions. Owltstanding results.
 */

namespace DL2\Slim\Module\Home;

use DL2\Slim\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Exception\NotFoundException;

class Index extends Controller
{
    /** @var string */
    const ENDPOINT = '/'; // if not set, it should be `/home/index`

    /** @var string[] */
    const QUOTES = [
        'Anything added dilutes everything else.',
        'Approachable is better than simple.',
        'Avoid administrative distraction.',
        'Encourage flow.',
        'Favor focus over features.',
        'Half measures are as bad as nothing at all.',
        'It\'s not fully shipped until it\'s fast.',
        'Keep it logically awesome.',
        'Mind your words, they are important.',
        'Non-blocking is better than blocking.',
        'Owlsome solutions. Owltstanding results.',
        'Practicality beats purity.',
        'Responsive is better than fast.',
        'Speak like a human.',
    ];

    /**
     * Show the default home page.
     *
     * @param PsrHttpMessageServerRequestInterface $request
     * @param PsrHttpMessageResponseInterface $response
     * @param array $args
     *
     * @return PsrHttpMessageResponseInterface
     */
    public function getAction(ServerRequestInterface $request, ResponseInterface $response, array $args) // @codingStandardsIgnoreLine
    {
        /** @var int $quoteId */
        $quoteId = $args['id'];

        if (isset(self::QUOTES[$quoteId])) {
            return $response->getBody()->write(self::QUOTES[$quoteId]);
        }

        throw new NotFoundException($request, $response);
    }

    /**
     * Show the default home page.
     *
     * @param PsrHttpMessageServerRequestInterface $request
     * @param PsrHttpMessageResponseInterface $response
     * @param array $args
     *
     * @return PsrHttpMessageResponseInterface
     */
    public function indexAction(ServerRequestInterface $request, ResponseInterface $response, array $args) // @codingStandardsIgnoreLine
    {
        return $response->getBody()->write(self::QUOTES[mt_rand(0, 13)]);
    }
}
