<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\DTO;

/**
 * Class MapObjectSummaryDTO
 * @package Kardasz\DTO
 */
class MapObjectSummaryDTO
{
    /**
     * @var int|null
     */
    private $id;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $description;

    /**
     * @var string|null
     */
    private $acc;

    /**
     * @var int|null
     */
    private $rpm;

    /**
     * @var float|null
     */
    private $fuel;

    /**
     * @var float|null
     */
    private $fuelTank;

    /**
     * @var float|null
     */
    private $lat;

    /**
     * @var float|null
     */
    private $lng;

    /**
     * @var string|null
     */
    private $driverName;

    /**
     * @var string|null
     */
    private $rideType;

    /**
     * @var int|null
     */
    private $gsmSignalLevel;

    /**
     * MapObjectSummaryDTO constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $k => $v) {
            $method = 'set' . ucfirst($k);
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], [$v]);
            }
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return null|string
     */
    public function getAcc(): ?string
    {
        return $this->acc;
    }

    /**
     * @param null|string $acc
     */
    public function setAcc(?string $acc): void
    {
        $this->acc = $acc;
    }

    /**
     * @return int|null
     */
    public function getRpm(): ?int
    {
        return $this->rpm;
    }

    /**
     * @param int|null $rpm
     */
    public function setRpm(?int $rpm): void
    {
        $this->rpm = $rpm;
    }

    /**
     * @return float|null
     */
    public function getFuel(): ?float
    {
        return $this->fuel;
    }

    /**
     * @param float|null $fuel
     */
    public function setFuel(?float $fuel): void
    {
        $this->fuel = $fuel;
    }

    /**
     * @return float|null
     */
    public function getFuelTank(): ?float
    {
        return $this->fuelTank;
    }

    /**
     * @param float|null $fuelTank
     */
    public function setFuelTank(?float $fuelTank): void
    {
        $this->fuelTank = $fuelTank;
    }

    /**
     * @return float|null
     */
    public function getLat(): ?float
    {
        return $this->lat;
    }

    /**
     * @param float|null $lat
     */
    public function setLat(?float $lat): void
    {
        $this->lat = $lat;
    }

    /**
     * @return float|null
     */
    public function getLng(): ?float
    {
        return $this->lng;
    }

    /**
     * @param float|null $lng
     */
    public function setLng(?float $lng): void
    {
        $this->lng = $lng;
    }

    /**
     * @return null|string
     */
    public function getDriverName(): ?string
    {
        return $this->driverName;
    }

    /**
     * @param null|string $driverName
     */
    public function setDriverName(?string $driverName): void
    {
        $this->driverName = $driverName;
    }

    /**
     * @return null|string
     */
    public function getRideType(): ?string
    {
        return $this->rideType;
    }

    /**
     * @param null|string $rideType
     */
    public function setRideType(?string $rideType): void
    {
        $this->rideType = $rideType;
    }

    /**
     * @return int|null
     */
    public function getGsmSignalLevel(): ?int
    {
        return $this->gsmSignalLevel;
    }

    /**
     * @param int|null $gsmSignalLevel
     */
    public function setGsmSignalLevel(?int $gsmSignalLevel): void
    {
        $this->gsmSignalLevel = $gsmSignalLevel;
    }
}
