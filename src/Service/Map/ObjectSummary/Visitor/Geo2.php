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
 * Class Geo2.
 */
class Geo2 implements VisitorInterface
{
    /**
     * @param MapObjectSummaryDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectSummaryDTO $dto, ?array $data = null): void
    {
        if (isset($data['last_record']['record_additional_data']['GpsLatitude'])) {
            $dto->setLat((float) $data['last_record']['record_additional_data']['GpsLatitude']);
        }

        if (isset($data['last_record']['record_additional_data']['GpsLongitude'])) {
            $dto->setLng((float) $data['last_record']['record_additional_data']['GpsLongitude']);
        }
    }
}
