<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Service\Map\ObjectSummary\Visitor;

/**
 * Interface VisitorChainInterface
 * @package Kardasz\Service\Map\ObjectSummary\Visitor
 */
interface VisitorChainInterface extends VisitorInterface
{
    /**
     * @param VisitorInterface $visitor
     */
    public function add(VisitorInterface $visitor): void;
}
