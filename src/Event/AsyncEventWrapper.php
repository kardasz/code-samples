<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class AsyncEventWrapper
 * @package Kardasz\Event
 */
class AsyncEventWrapper extends Event
{
    /**
     * @var AsyncEventInterface
     */
    private $event;

    const NAME = 'async_event_wrapper';

    /**
     * AsyncEventWrapper constructor.
     * @param AsyncEventInterface $event
     */
    public function __construct(AsyncEventInterface $event)
    {
        $this->event = $event;
    }

    /**
     * @return AsyncEventInterface
     */
    public function getEvent(): AsyncEventInterface
    {
        return $this->event;
    }
}
