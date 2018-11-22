<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Service\Map\ObjectDetails\Visitor;

use DateTime;
use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\VO\FillingVO;

/**
 * Class Fillings.
 */
class Fillings implements VisitorInterface
{
    /**
     * @param MapObjectDetailsDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectDetailsDTO $dto, ?array $data = null): void
    {
        if (!empty($data['fillings'])) {
            $dto->setFillings(
                $this->flatMapFillings($data['fillings'])
            );
        }
    }

    /**
     * @param array $fillings
     *
     * @return FillingVO[]
     */
    private function flatMapFillings(array $fillings): array
    {
        return array_map(
            function ($filling) {
                return new FillingVO(
                    new DateTime('@'.$filling['filling_timestamp']),
                    (float) $filling['filling_value'],
                    (float) $filling['filling_distance']
                );
            },
            $fillings
        );
    }
}
