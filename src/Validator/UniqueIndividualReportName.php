<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class UniqueIndividualReportName
 * @package Kardasz\Validator
 * @Annotation
 */
class UniqueIndividualReportName extends Constraint
{
    /**
     * @var string
     */
    public $message = 'The  report name "{{ name }}" already exists';

    /**
     * @var string
     */
    public $excludeId;

    /**
     * {@inheritDoc}
     */
    public function validatedBy()
    {
        return UniqueIndividualReportNameValidator::class;
    }
}
