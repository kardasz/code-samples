<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;

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
     * @param MapObjectDetailsDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectDetailsDTO $dto, ?array $data = null): void
    {
        foreach ($this->chain as $visitor) {
            $visitor->visit($dto, $data);
        }
    }
}
