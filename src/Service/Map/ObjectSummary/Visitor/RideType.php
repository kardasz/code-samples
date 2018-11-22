<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;
use translate;

/**
 * Class RideType
 * @package Kardasz\Service\Map\ObjectSummary\Visitor
 */
class RideType implements VisitorInterface
{
    const TYPE_PRIVATE = 'private';
    const TYPE_BUSINESS = 'business';

    /**
     * @param MapObjectSummaryDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectSummaryDTO $dto, ?array $data = null): void
    {
        if (isset($data['last_record']['record_device_state'])) {
            $dto->setRideType(
                ($data['last_record']['record_device_state'] & 16) == 16
                ? self::TYPE_PRIVATE
                : self::TYPE_BUSINESS
            );
        }
    }
}
