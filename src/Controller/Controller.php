<?php

declare(strict_types=1);

namespace App\Controller;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

/**
 * Class Controller
 * @package App\Controller
 */
abstract class Controller
{
    abstract public function action(ServerRequestInterface $request): ResponseInterface;

    /**
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        try {
            return $this->action($request);
        } catch (Exception $exception) {
            return $this->createErrorApiResponse($exception->getMessage(),500);
        }
    }

    /**
     * @param $data
     * @param int $statusCode
     *
     * @return ResponseInterface
     */
    protected function createApiResponse($data, int $statusCode): ResponseInterface
    {
        return $this->createJsonResponse(
            [
                'data' => $data,
                'error' => null
            ],
            $statusCode
        );
    }

    /**
     * @param string $errorMessage
     * @param int $statusCode
     *
     * @return ResponseInterface
     */
    protected function createErrorApiResponse(string $errorMessage, int $statusCode): ResponseInterface
    {
        return $this->createJsonResponse(['error' => $errorMessage], $statusCode);
    }

    /**
     * @param string $html
     *
     * @return ResponseInterface
     */
    protected function createHtmlResponse(string $html): ResponseInterface
    {
        $headers = ['Content-Type' => 'text/html'];
        $response = new Response('php://memory', 200, $headers);
        $response->getBody()->write($html);
        return $response;
    }


    /**
     * @param array $body
     * @param int $statusCode
     * @return ResponseInterface
     */
    private function createJsonResponse(array $body, int $statusCode): ResponseInterface
    {
        $headers = ['Content-Type' => 'application/json'];
        $response = new Response('php://memory', $statusCode, $headers);
        $response->getBody()->write(json_encode($body));
        return $response;
    }
}