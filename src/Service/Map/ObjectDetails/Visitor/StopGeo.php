<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;

/**
 * Class StopGeo
 * @package Kardasz\Service\Map\ObjectDetails\Visitor
 */
class StopGeo implements VisitorInterface
{
    /**
     * @param MapObjectDetailsDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectDetailsDTO $dto, ?array $data = null): void
    {
        if (!empty($data['summary']['posstop']['record_gps_latitude'])) {
            $dto->setStopLat((float)$data['summary']['posstop']['record_gps_latitude']);
        }

        if (!empty($data['summary']['posstop']['record_gps_longitude'])) {
            $dto->setStopLng((float)$data['summary']['posstop']['record_gps_longitude']);
        }
    }
}
