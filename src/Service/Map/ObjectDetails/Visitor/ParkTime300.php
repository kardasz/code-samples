<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;

/**
 * Class ParkTime300
 * @package Kardasz\Service\Map\ObjectDetails\Visitor
 */
class ParkTime300 implements VisitorInterface
{
    /**
     * @param MapObjectDetailsDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectDetailsDTO $dto, ?array $data = null): void
    {
        if (!empty($data['summary']['parktime_300'])) {
            $dto->setParkTime300((int)$data['summary']['parktime_300']);
        }
    }
}
