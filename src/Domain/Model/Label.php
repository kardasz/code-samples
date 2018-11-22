<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Domain\Model;

use Serializable;
use JsonSerializable;

/**
 * Class Label.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 */
class Label implements Serializable, JsonSerializable
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * Label constructor.
     *
     * @param string $name
     * @param string $value
     */
    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize()
    {
        return json_encode($this);
    }

    /**
     * @param array $data
     *
     * @return Label
     */
    public static function deserialize(array $data): ?Label
    {
        if (isset($data['name'], $data['value'])) {
            return new self((string) $data['name'], (string) $data['value']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function unserialize($serialized)
    {
        $data = json_decode($serialized, true);
        if (JSON_ERROR_NONE === json_last_error() && isset($data['name'], $data['value'])) {
            $this->name = $data['name'];
            $this->value = $data['value'];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'value' => $this->getValue(),
        ];
    }
}
