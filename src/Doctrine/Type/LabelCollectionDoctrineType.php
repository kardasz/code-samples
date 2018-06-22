<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Kardasz\Domain\Model\Label;

/**
 * Class LabelCollectionDoctrineType
 * @package Kardasz\Doctrine\Type
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 */
class LabelCollectionDoctrineType extends Type
{
    const NAME = 'label_collection';

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getJsonTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!is_array($value)) {
            return json_encode([]);
        }

        return json_encode($value);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value === '') {
            return [];
        }

        $value = (is_resource($value)) ? stream_get_contents($value) : $value;
        $decoded = json_decode($value, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            return [];
        }

        $collection = [];
        foreach ($decoded as $item) {
            $collection[] = Label::deserialize($item);
        }

        return $collection;
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return static::NAME;
    }
}
