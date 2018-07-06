<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class DateGreaterThanValidator
 * @package Kardasz\Validator
 */
class DateGreaterThanValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (empty($value)) {
            return ;
        }

        $field = $constraint->field;
        $element = $this->context->getRoot()->get($field);
        if (null !== $element) {
            $value2 = $element->getData();

            if (empty($value2) || new \DateTime($value2) >= new \DateTime($value)) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
                return ;
            }
        }
    }
}
