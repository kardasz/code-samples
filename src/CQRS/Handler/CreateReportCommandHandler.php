<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\CQRS\Handler;

use Broadway\CommandHandling\SimpleCommandHandler;
use Kardasz\CQRS\Command\CreateReportCommand;
use Kardasz\Entity\IndividualReport;
use Kardasz\Service\IndividualReportService;

/**
 * Class CreateReportCommandHandler.
 */
class CreateReportCommandHandler extends SimpleCommandHandler
{
    /**
     * @var IndividualReportService
     */
    private $reportService;

    /**
     * CreateReportCommandHandler constructor.
     *
     * @param IndividualReportService $reportService
     */
    public function __construct(IndividualReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * @param CreateReportCommand $command
     */
    public function handleCreateReportCommand(CreateReportCommand $command)
    {
        $entity = new IndividualReport();
        $entity->setCategory($command->getCategory());
        $entity->setName($command->getName());
        $entity->setAuthor($command->getAuthor());
        $entity->setFilePath($command->getFilepath());
        $entity->setCreatedAt($command->getDate());

        $this->reportService->save($entity);
    }
}
