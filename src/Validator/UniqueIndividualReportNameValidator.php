<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Validator;

use Kardasz\Entity\IndividualReport;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class UniqueIndividualReportNameValidator
 * @package Kardasz\Validator
 */
class UniqueIndividualReportNameValidator extends ConstraintValidator
{
    /**
     * @var RegistryInterface
     */
    private $doctrine;

    /**
     * UniqueIndividualReportNameValidator constructor.
     * @param RegistryInterface $doctrine
     */
    public function __construct(RegistryInterface $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        $repository = $this->doctrine->getRepository(IndividualReport::class);
        if ($report = $repository->findBy(['name' => $value])) {
            if (empty($constraint->excludeId) || (string)$report->getId() == (string)$constraint->excludeId) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ name }}', $value)
                    ->addViolation();
            }
        }
    }
}
