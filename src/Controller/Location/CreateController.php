<?php
declare(strict_types=1);

namespace App\Controller\Location;

use App\Controller\Controller;
use App\Service\LocationServiceInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response;

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

        try {
            $id = $this->locationService->createLocation($name, $address, $latitude, $longitude);
        } catch (\Exception $exception) {
            return $this->createErrorApiResponse($exception->getMessage(), 500);
        }

        return $this->createApiResponse(['id' => $id], 200);
    }
}