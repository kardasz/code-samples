<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\VO;

use DateTime;

/**
 * Class FillingVO.
 */
class FillingVO
{
    /** @var int|null */
    private $date;

    /** @var float|null */
    private $value;

    /** @var float|null */
    private $distance;

    /**
     * FillingVO constructor.
     *
     * @param int|DateTime $date
     * @param float|null   $value
     * @param float|null   $distance
     */
    public function __construct(?DateTime $date, ?float $value, ?float $distance)
    {
        $this->date = $date;
        $this->value = $value;
        $this->distance = $distance;
    }

    /**
     * @return DateTime|null
     */
    public function getDate(): ?DateTime
    {
        return $this->date;
    }

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @return float|null
     */
    public function getDistance(): ?float
    {
        return $this->distance;
    }
}
