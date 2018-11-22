<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;

/**
 * Class StartGeo
 * @package Kardasz\Service\Map\ObjectDetails\Visitor
 */
class StartGeo implements VisitorInterface
{
    /**
     * @param MapObjectDetailsDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectDetailsDTO $dto, ?array $data = null): void
    {
        if (!empty($data['summary']['posstart']['record_gps_latitude'])) {
            $dto->setStartLat((float)$data['summary']['posstart']['record_gps_latitude']);
        }

        if (!empty($data['summary']['posstart']['record_gps_longitude'])) {
            $dto->setStartLng((float)$data['summary']['posstart']['record_gps_longitude']);
        }
    }
}
