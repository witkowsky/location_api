<?php
declare(strict_types=1);

namespace App\Controller\Location;

use App\Service\LocationFinderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

/**
 * Class FindByIdController
 * @package App\Controller\Location
 */
class FindByIdController
{
    /**
     * @var LocationFinderInterface
     */
    private $finder;

    /**
     * FindByIdController constructor.
     * @param LocationFinderInterface $finder
     */
    public function __construct(LocationFinderInterface $finder)
    {
        $this->finder = $finder;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $id = (int) $request->getAttribute('id');
        $dto = $this->finder->findById($id);

        if (!$dto) {
            $body = json_encode(['error' => sprintf('Location %s not found', $id)]);
            $status = 404;
            $headers = ['Content-Type' => 'application/json'];

            return $this->createResponse($body, $status, $headers);
        }

        $body = json_encode($dto);
        $status = 200;
        $headers = ['Content-Type' => 'application/json'];
        return $this->createResponse($body, $status, $headers);
    }

    /**
     * @param string $body
     * @param int $status
     * @param array $headers
     *
     * @return ResponseInterface
     */
    private function createResponse(string $body, int $status, array $headers): ResponseInterface
    {
        $response = new Response('php://memory', $status, $headers);
        $response->getBody()->write($body);
        return $response;
    }
}