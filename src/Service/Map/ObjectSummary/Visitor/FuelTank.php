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
 * Class FuelTank.
 */
class FuelTank implements VisitorInterface
{
    /**
     * @param MapObjectSummaryDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectSummaryDTO $dto, ?array $data = null): void
    {
        if (isset($data['fuel_tank_1'], $data['fuel_tank_2'])) {
            $dto->setFuelTank((float) $data['fuel_tank_1'] + (float) $data['fuel_tank_2']);
        }
    }
}
