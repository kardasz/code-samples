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
 * Class ParkTime300Count.
 */
class ParkTime300Count implements VisitorInterface
{
    /**
     * @param MapObjectDetailsDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectDetailsDTO $dto, ?array $data = null): void
    {
        if (!empty($data['summary']['parktime_300_count'])) {
            $dto->setParkTime300Count((int) $data['summary']['parktime_300_count']);
        }
    }
}
