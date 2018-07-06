<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Form;

use Doctrine\ORM\EntityRepository;
use Kardasz\Entity\ReportCategory;
use Kardasz\Validator\UniqueIndividualReportName;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class IndividualReportType
 * @package Kardasz\Form
 */
class IndividualReportType extends AbstractType
{
    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'label' => 'Category',
                'class' => ReportCategory::class,
                'choice_label' => 'name',
                'query_builder' => function (EntityRepository $er) use ($builder, $options) {
                    return $er->createQueryBuilder('c')
                        ->where('c.status = :status')
                        ->orderBy('c.name', 'ASC')
                        ->setParameter('status', ReportCategory::STATUS_ACTIVE);
                },
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                ),
            ])
            ->add('name', TextType::class, [
                'label' => 'Report name',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 8]),
                    new UniqueIndividualReportName()
                ),
            ])
            ->add('author', TextType::class, [
                'label' => 'Author',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 8]),
                ),
            ])
            ->add('file', FileType::class, [
                'label' => 'Report file',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\File([
                        'maxSize' => '10M',
                        'mimeTypes' => ['application/pdf', '	application/msword']
                    ]),
                ),
            ])
            ->add('date', TextType::class, [
                'label' => 'Report date',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\DateTime(['format' => 'Y-m-d H:i:s']),
                ),
            ])
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null
        ]);
    }
}
