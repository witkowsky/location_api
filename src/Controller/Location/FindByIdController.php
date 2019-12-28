<?php
declare(strict_types=1);

namespace App\Controller\Location;

use App\Controller\Controller;
use App\Service\LocationFinderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FindByIdController
 * @package App\Controller\Location
 */
class FindByIdController extends Controller
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
    public function action(ServerRequestInterface $request): ResponseInterface
    {
        $id = (int) $request->getAttribute('id');
        $dto = $this->finder->findById($id);

        if (!$dto) {
            return $this->createErrorApiResponse(sprintf('Location %s not found', $id), 404);
        }

        return $this->createApiResponse($dto, 200);
    }
}