<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Service;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\DTO\MapObjectSummaryDTO;
use Kardasz\Service\Map\ObjectDetails\Visitor\VisitorChainInterface as ObjectDetailsVisitorChainInterface;
use Kardasz\Service\Map\ObjectSummary\Visitor\VisitorChainInterface as ObjectSummaryVisitorChainInterface;

/**
 * Class MapService.
 */
class MapService implements MapServiceInterface
{
    /** @var ObjectSummaryVisitorChainInterface */
    private $objectSummaryVisitorChain;

    /** @var ObjectDetailsVisitorChainInterface */
    private $objectDetailsVisitorChain;

    /**
     * MapService constructor.
     *
     * @param ObjectSummaryVisitorChainInterface $objectSummaryVisitorChain
     * @param ObjectDetailsVisitorChainInterface $objectDetailsVisitorChain
     */
    public function __construct(
        ObjectSummaryVisitorChainInterface $objectSummaryVisitorChain,
        ObjectDetailsVisitorChainInterface $objectDetailsVisitorChain
    ) {
        $this->objectSummaryVisitorChain = $objectSummaryVisitorChain;
        $this->objectDetailsVisitorChain = $objectDetailsVisitorChain;
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectSummary(array $data): MapObjectSummaryDTO
    {
        $dto = new MapObjectSummaryDTO();
        $this->objectSummaryVisitorChain->visit($dto, $data);

        return $dto;
    }

    /**
     * {@inheritdoc}
     */
    public function getObjectDetails(array $data): MapObjectDetailsDTO
    {
        $dto = new MapObjectDetailsDTO();
        $this->objectDetailsVisitorChain->visit($dto, $data);

        return $dto;
    }
}
