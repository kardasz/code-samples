<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Service\Map\ObjectDetails\Visitor;

use DateTime;
use Exception;
use Kardasz\DTO\MapObjectDetailsDTO;

/**
 * Class Workstop.
 */
class Workstop implements VisitorInterface
{
    /**
     * @param MapObjectDetailsDTO $dto
     * @param array|null          $data
     *
     * @throws Exception
     */
    public function visit(MapObjectDetailsDTO $dto, ?array $data = null): void
    {
        if (!empty($data['summary']['workstop'])) {
            $dto->setWorkstop(new DateTime('@'.$data['summary']['workstop']));
        }
    }
}
