<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Event;

/**
 * Interface AsyncEventDispatcherInterface
 * @package Kardasz\Event
 */
interface AsyncEventDispatcherInterface
{
    /**
     * @param AsyncEventInterface $event
     * @return mixed
     */
    public function dispatch(AsyncEventInterface $event) : void;
}
