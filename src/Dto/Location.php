<?php

declare(strict_types=1);

namespace App\Dto;

use JsonSerializable;

/**
 * Class Location
 * @package App\Dto
 */
class Location implements JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var float
     */
    private $longitude;

    /**
     * Location constructor.
     *
     * @param int $id
     * @param string $name
     * @param string $address
     * @param float $latitude
     * @param float $longitude
     */
    public function __construct(int $id, string $name, string $address, float $latitude, float $longitude)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "address" => $this->address,
            "latitude" => $this->latitude,
            "longitude" => $this->longitude,
        ];
    }


}