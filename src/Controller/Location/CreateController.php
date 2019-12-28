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
        $name = $body['name'];
        $address = $body['address'];
        $latitude = (float) $body['latitude'];
        $longitude = (float) $body['longitude'];

        $id = $this->locationService->createLocation($name, $address, $latitude, $longitude);

        return $this->createApiResponse(['id' => $id], 200);
    }
}