<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class DateGreaterThan.
 *
 * @Annotation
 */
class DateGreaterThan extends Constraint
{
    /**
     * @var string
     */
    public $field = null;

    /**
     * @var string
     */
    public $message = 'Date must be greater than';

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return DateGreaterThanValidator::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getTargets()
    {
        return [self::CLASS_CONSTRAINT, self::PROPERTY_CONSTRAINT];
    }
}
