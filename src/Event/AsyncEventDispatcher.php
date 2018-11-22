<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Event;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class AsyncEventDispatcher.
 */
class AsyncEventDispatcher implements AsyncEventDispatcherInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * AsyncEventDispatcher constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param AsyncEventInterface $event
     *
     * @return mixed
     */
    public function dispatch(AsyncEventInterface $event): void
    {
        $this->eventDispatcher->dispatch(AsyncEventWrapper::NAME, new AsyncEventWrapper($event));
    }
}
