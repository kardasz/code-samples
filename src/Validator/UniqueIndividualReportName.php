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
 * Class UniqueIndividualReportName.
 *
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
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return UniqueIndividualReportNameValidator::class;
    }
}
