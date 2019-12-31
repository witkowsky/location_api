<?php
declare(strict_types=1);

namespace App\Controller\Location;

use App\Controller\Controller;
use App\Service\LocationServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class CreateController
 * @package App\Controller\Location
 */
class CreateController extends Controller
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
        $body = $request->getParsedBody();
        $name = $body['name'] ?? null;
        $address = $body['address'] ?? null;
        $latitude =  $body['latitude'] ?? null;
        $longitude =  $body['longitude'] ?? null;

        $this->checkParameter($name, 'name');
        $this->checkParameter($address, 'address');
        $this->checkParameter($latitude, 'latitude');
        $this->checkParameter($longitude, 'longitude');

        $id = $this->locationService->createLocation(
            (string) $name,
            (string) $address,
            (float) $latitude,
            (float) $longitude
        );

        return $this->createApiResponse(['id' => $id], 200);
    }
}