<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;

/**
 * Class Geo
 * @package Kardasz\Service\Map\ObjectSummary\Visitor
 */
class Geo implements VisitorInterface
{
    /**
     * @param MapObjectSummaryDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectSummaryDTO $dto, ?array $data = null): void
    {
        if (isset($data['last_record']['record_gps_latitude'])) {
            $dto->setLat((float)$data['last_record']['record_gps_latitude']);
        }

        if (isset($data['last_record']['record_gps_longitude'])) {
            $dto->setLng((float)$data['last_record']['record_gps_longitude']);
        }
    }
}
