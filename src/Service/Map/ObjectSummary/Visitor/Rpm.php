<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Service\Map\ObjectSummary\Visitor;

use Kardasz\DTO\MapObjectSummaryDTO;

/**
 * Class Rpm
 * @package Kardasz\Service\Map\ObjectSummary\Visitor
 */
class Rpm implements VisitorInterface
{
    /**
     * @param MapObjectSummaryDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectSummaryDTO $dto, ?array $data = null): void
    {
        $dto->setRpm((isset($data['last_record']['record_rpm'])) ? (int)$data['last_record']['record_rpm'] : null);
    }
}
