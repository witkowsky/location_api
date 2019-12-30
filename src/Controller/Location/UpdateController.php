<?php
declare(strict_types=1);

namespace App\Controller\Location;

use App\Controller\Controller;
use App\Service\LocationFinderInterface;
use App\Service\LocationServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class UpdateController
 * @package App\Controller\Location
 */
class UpdateController extends Controller
{
    /**
     * @var LocationServiceInterface
     */
    private $locationService;

    /**
     * @var LocationFinderInterface
     */
    private $locationFinder;

    /**
     * RemoveController constructor.
     * @param LocationServiceInterface $locationService
     * @param LocationFinderInterface $locationFinder
     */
    public function __construct(
        LocationServiceInterface $locationService,
        LocationFinderInterface $locationFinder
    ) {
        $this->locationService = $locationService;
        $this->locationFinder = $locationFinder;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function action(ServerRequestInterface $request): ResponseInterface
    {
        $id = (int) $request->getAttribute('id');
        $body = $request->getParsedBody();
        $name = $body['name'] ?? null;
        $address = $body['address'] ?? null;
        $latitude = $body['latitude'] ?? null;
        $latitude = $latitude ? (float) $latitude : null;
        $longitude = $body['longitude'] ?? null;
        $longitude = $longitude ? (float) $longitude : null;

        $this->locationService->updateLocation($id, $name, $address, $latitude, $longitude);

        $dto = $this->locationFinder->findById($id);
        return $this->createApiResponse($dto, 200);
    }
}