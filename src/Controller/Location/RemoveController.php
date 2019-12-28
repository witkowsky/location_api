<?php
declare(strict_types=1);

namespace App\Controller\Location;

use App\Controller\Controller;
use App\Service\LocationServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

/**
 * Class RemoveController
 * @package App\Controller\Location
 */
class RemoveController extends Controller
{
    /**
     * @var LocationServiceInterface
     */
    private $locationService;

    /**
     * RemoveController constructor.
     * @param LocationServiceInterface $locationService
     */
    public function __construct(LocationServiceInterface $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function action(ServerRequestInterface $request): ResponseInterface
    {
        $id = (int) $request->getAttribute('id');
        try {
            $this->locationService->removeLocation($id);
        } catch (\Exception $exception) {
            return $this->createErrorApiResponse($exception->getMessage(), 500);
        }

        return $this->createApiResponse([], 200);
    }
}