<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\DTO;

use DateTime;
use Kardasz\VO\AcVO;
use Kardasz\VO\FillingVO;

/**
 * Class MapObjectDetailsDTO.
 */
class MapObjectDetailsDTO
{
    /** @var int|null */
    private $odometer;

    /** @var float|null */
    private $distance;

    /** @var DateTime */
    private $workstart;

    /** @var DateTime */
    private $workstop;

    /** @var float|null */
    private $startLat;

    /** @var float|null */
    private $startLng;

    /** @var float|float */
    private $stopLat;

    /** @var float|null */
    private $stopLng;

    /** @var int|null */
    private $driveTime;

    /** @var int|null */
    private $parkTime;

    /** @var int|null */
    private $parkStopTime;

    /** @var int|null */
    private $parkTime300;

    /** @var int|null */
    private $parkTime300Count;

    /** @var FillingVO[] */
    private $fillings = [];

    /** @var AcVO[] */
    private $ac = [];

    /**
     * MapObjectDetailsDTO constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $k => $v) {
            $method = 'set'.ucfirst($k);
            if (method_exists($this, $method)) {
                call_user_func_array([$this, $method], [$v]);
            }
        }
    }

    /**
     * @return int|null
     */
    public function getOdometer(): ?int
    {
        return $this->odometer;
    }

    /**
     * @param int|null $odometer
     */
    public function setOdometer(?int $odometer): void
    {
        $this->odometer = $odometer;
    }

    /**
     * @return float|null
     */
    public function getDistance(): ?float
    {
        return $this->distance;
    }

    /**
     * @param float|null $distance
     */
    public function setDistance(?float $distance): void
    {
        $this->distance = $distance;
    }

    /**
     * @return DateTime|null
     */
    public function getWorkstart(): ?DateTime
    {
        return $this->workstart;
    }

    /**
     * @param DateTime|null $workstart
     */
    public function setWorkstart(?DateTime $workstart): void
    {
        $this->workstart = $workstart;
    }

    /**
     * @return DateTime|null
     */
    public function getWorkstop(): ?DateTime
    {
        return $this->workstop;
    }

    /**
     * @param DateTime|null $workstop
     */
    public function setWorkstop(?DateTime $workstop): void
    {
        $this->workstop = $workstop;
    }

    /**
     * @return float|null
     */
    public function getStartLat(): ?float
    {
        return $this->startLat;
    }

    /**
     * @param float|null $startLat
     */
    public function setStartLat(?float $startLat): void
    {
        $this->startLat = $startLat;
    }

    /**
     * @return float|null
     */
    public function getStartLng(): ?float
    {
        return $this->startLng;
    }

    /**
     * @param float|null $startLng
     */
    public function setStartLng(?float $startLng): void
    {
        $this->startLng = $startLng;
    }

    /**
     * @return float|null
     */
    public function getStopLat(): ?float
    {
        return $this->stopLat;
    }

    /**
     * @param float|null $stopLat
     */
    public function setStopLat(?float $stopLat): void
    {
        $this->stopLat = $stopLat;
    }

    /**
     * @return float|null
     */
    public function getStopLng(): ?float
    {
        return $this->stopLng;
    }

    /**
     * @param float|null $stopLng
     */
    public function setStopLng(?float $stopLng): void
    {
        $this->stopLng = $stopLng;
    }

    /**
     * @return int|null
     */
    public function getDriveTime(): ?int
    {
        return $this->driveTime;
    }

    /**
     * @return float
     */
    public function getDriveHours(): float
    {
        return floor($this->driveTime / 3600);
    }

    /**
     * @return float
     */
    public function getDriveMinutes(): float
    {
        return floor($this->driveTime % 3600 / 60);
    }

    /**
     * @param int|null $driveTime
     */
    public function setDriveTime(?int $driveTime): void
    {
        $this->driveTime = $driveTime;
    }

    /**
     * @return int|null
     */
    public function getParkTime(): ?int
    {
        return $this->parkTime;
    }

    /**
     * @return float
     */
    public function getParkHours(): float
    {
        return floor($this->parkTime / 3600);
    }

    /**
     * @return float
     */
    public function getParkMinutes(): float
    {
        return floor($this->parkTime % 3600 / 60);
    }

    /**
     * @param int|null $parkTime
     */
    public function setParkTime(?int $parkTime): void
    {
        $this->parkTime = $parkTime;
    }

    /**
     * @return int|null
     */
    public function getParkStopTime(): ?int
    {
        return $this->parkStopTime;
    }

    /**
     * @return float
     */
    public function getParkStopHours(): float
    {
        return floor($this->parkStopTime / 3600);
    }

    /**
     * @return float
     */
    public function getParkStopMinutes(): float
    {
        return floor($this->parkStopTime % 3600 / 60);
    }

    /**
     * @param int|null $parkStopTime
     */
    public function setParkStopTime(?int $parkStopTime): void
    {
        $this->parkStopTime = $parkStopTime;
    }

    /**
     * @return int|null
     */
    public function getParkTime300(): ?int
    {
        return $this->parkTime300;
    }

    /**
     * @return float
     */
    public function getParkTime300Hours(): float
    {
        return floor($this->parkTime300 / 3600);
    }

    /**
     * @return float
     */
    public function getParkTime300Minutes(): float
    {
        return floor($this->parkTime300 % 3600 / 60);
    }

    /**
     * @param int|null $parkTime300
     */
    public function setParkTime300(?int $parkTime300): void
    {
        $this->parkTime300 = $parkTime300;
    }

    /**
     * @return int|null
     */
    public function getParkTime300Count(): ?int
    {
        return $this->parkTime300Count;
    }

    /**
     * @param int|null $parkTime300Count
     */
    public function setParkTime300Count(?int $parkTime300Count): void
    {
        $this->parkTime300Count = $parkTime300Count;
    }

    /**
     * @return FillingVO[]
     */
    public function getFillings(): array
    {
        return $this->fillings;
    }

    /**
     * @param FillingVO $filling
     */
    public function addFilling(FillingVO $filling): void
    {
        $this->fillings[] = $filling;
    }

    /**
     * @param FillingVO[] $fillings
     */
    public function setFillings(array $fillings): void
    {
        $this->fillings = $fillings;
    }

    /**
     * @return AcVO[]
     */
    public function getAc(): array
    {
        return $this->ac;
    }

    /**
     * @param AcVO[] $ac
     */
    public function setAc(array $ac): void
    {
        $this->ac = $ac;
    }

    /**
     * @param AcVO $ac
     */
    public function addAc(AcVO $ac): void
    {
        $this->ac[] = $ac;
    }
}
