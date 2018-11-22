<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;

/**
 * Class VisitorChain.
 */
class VisitorChain implements VisitorChainInterface
{
    /** @var VisitorInterface[] */
    private $chain = [];

    /**
     * @param VisitorInterface $visitor
     */
    public function add(VisitorInterface $visitor): void
    {
        $this->chain[] = $visitor;
    }

    /**
     * @param MapObjectSummaryDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectSummaryDTO $dto, ?array $data = null): void
    {
        foreach ($this->chain as $visitor) {
            $visitor->visit($dto, $data);
        }
    }
}
