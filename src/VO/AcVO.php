<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\VO;

/**
 * Class FillingVO.
 */
class AcVO
{
    const UNIT_CELCIUS = 'C';
    const UNIT_VOLT = 'V';
    const TYPE_ANALOG = 'analog';
    const TYPE_TEMP = 'temp';

    /** @var string|null */
    private $name;

    /** @var float|null */
    private $value;

    /** @var string|null */
    private $type;

    /** @var string|null */
    private $unit;

    /**
     * AcVO constructor.
     *
     * @param null|string $name
     * @param float|null  $value
     * @param null|string $type
     * @param null|string $unit
     */
    public function __construct(?string $name, ?float $value, ?string $type, ?string $unit = null)
    {
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->unit = $unit ?: $this->getUnitByType($type);
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @return null|string
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     *
     * @return null|string
     */
    private function getUnitByType(?string $type): ?string
    {
        switch ($type) {
            case self::TYPE_ANALOG:
                return self::UNIT_VOLT;
            case self::TYPE_TEMP:
                return self::UNIT_CELCIUS;
        }

        return null;
    }
}
