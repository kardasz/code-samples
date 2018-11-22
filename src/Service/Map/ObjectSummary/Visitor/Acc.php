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
 * Class Acc.
 */
class Acc implements VisitorInterface
{
    /**
     * @param MapObjectSummaryDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectSummaryDTO $dto, ?array $data = null): void
    {
        if (isset($data['last_record']['record_additional_data']['SensorAcc'])) {
            $dto->setAcc($data['last_record']['record_additional_data']['SensorAcc']);
        }
    }
}
