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
 * Class Odometer.
 */
class Odometer implements VisitorInterface
{
    /**
     * @param MapObjectDetailsDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectDetailsDTO $dto, ?array $data = null): void
    {
        if (!empty($data['summary']['last_odo'])) {
            $dto->setOdometer((int) $data['summary']['last_odo']);
        }
    }
}
