<?php
declare(strict_types=1);

namespace App\Controller\Location;

use App\Controller\Controller;
use App\Service\LocationFinderInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class FilterController
 * @package App\Controller\Location
 */
class FilterController extends Controller
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
        $params = $request->getQueryParams();
        $text = $params['text'] ?? null;
        $distance = $params['distance'] ?? null;
        $distance = $distance ? (int) $distance : null;

        $locations = $this->finder->findByTextAndDistance($text, $distance);

        return $this->createApiResponse($locations, 200);
    }
}