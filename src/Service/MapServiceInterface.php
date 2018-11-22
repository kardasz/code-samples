<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Service;

use Kardasz\DTO\MapObjectDetailsDTO;
use Kardasz\DTO\MapObjectSummaryDTO;

/**
 * Interface MapServiceInterface
 * @package Kardasz\Service
 */
interface MapServiceInterface
{
    /**
     * @param array $data
     * @return MapObjectSummaryDTO
     */
    public function getObjectSummary(array $data): MapObjectSummaryDTO;

    /**
     * @param array $data
     * @return MapObjectDetailsDTO
     */
    public function getObjectDetails(array $data): MapObjectDetailsDTO;
}
