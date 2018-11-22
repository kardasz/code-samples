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
 * Class Id.
 */
class Id implements VisitorInterface
{
    /**
     * @param MapObjectSummaryDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectSummaryDTO $dto, ?array $data = null): void
    {
        $dto->setId((isset($data['object_id'])) ? (int) $data['object_id'] : null);
    }
}
