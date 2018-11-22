<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Service;

use Kardasz\Entity\IndividualReport;
use Kardasz\Event\AsyncEventDispatcherInterface;
use Kardasz\Event\IndividualReportCreatedEvent;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class IndividualReportService.
 */
class IndividualReportService
{
    /**
     * @var AsyncEventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var RegistryInterface
     */
    private $registry;

    /**
     * IndividualReportService constructor.
     *
     * @param AsyncEventDispatcherInterface $eventDispatcher
     * @param RegistryInterface             $registry
     */
    public function __construct(
        AsyncEventDispatcherInterface $eventDispatcher,
        RegistryInterface $registry
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->registry = $registry;
    }

    /**
     * @param IndividualReport $entity
     */
    public function save(IndividualReport $entity)
    {
        $this->registry->getManager()->persist($entity);
        $this->registry->getManager()->flush();
        $this->eventDispatcher->dispatch(new IndividualReportCreatedEvent((string) $entity->getId()));
    }
}
