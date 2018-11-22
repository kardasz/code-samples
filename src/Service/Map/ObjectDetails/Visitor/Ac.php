<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Service\Map\ObjectDetails\Visitor;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\VO\AcVO;

/**
 * Class Ac.
 */
class Ac implements VisitorInterface
{
    /**
     * @param MapObjectDetailsDTO $dto
     * @param array|null          $data
     */
    public function visit(MapObjectDetailsDTO $dto, ?array $data = null): void
    {
        if (!empty($data['lastrec']['record_io'])) {
            $dto->setAc(
                $this->flatMapRecordIO($data['lastrec']['record_io'])
            );
        }
    }

    /**
     * @param array $recordIO
     *
     * @return AcVO[]
     */
    private function flatMapRecordIO(array $recordIO): array
    {
        array_walk($recordIO, function (&$entries, $type) {
            $entries = $this->flatMapRecordIOType($entries, $type);
        });

        return array_reduce($recordIO, function (array $carry, array $item) {
            return array_merge($carry, $item);
        }, []);
    }

    /**
     * @param array  $entries
     * @param string $type
     *
     * @return AcVO[]
     */
    private function flatMapRecordIOType(array $entries, string $type): array
    {
        return array_map(
            function ($entry) use ($type) {
                return new AcVO(
                    $entry[1],
                    $entry[0],
                    $type
                );
            },
            $entries
        );
    }
}
