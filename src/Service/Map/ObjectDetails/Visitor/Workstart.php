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
 * Class Workstart.
 */
class Workstart implements VisitorInterface
{
    /**
     * @param MapObjectDetailsDTO $dto
     * @param array|null          $data
     *
     * @throws Exception
     */
    public function visit(MapObjectDetailsDTO $dto, ?array $data = null): void
    {
        if (!empty($data['summary']['workstart'])) {
            $dto->setWorkstart(new DateTime('@'.$data['summary']['workstart']));
        }
    }
}
