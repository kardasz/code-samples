<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\EventSubscriber;

use Kardasz\AMQP\Publisher\MessagePublisherInterface;
use Kardasz\Event\AsyncEventWrapper;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class AsyncEventSubscriber
 * @package Kardasz\EventSubscriber
 */
class AsyncEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var MessagePublisherInterface
     */
    private $publisher;

    /**
     * AsyncEventSubscriber constructor.
     * @param MessagePublisherInterface $publisher
     */
    public function __construct(MessagePublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            AsyncEventWrapper::NAME => [
                ['publish', 10]
            ]
        ];
    }

    /**
     * @param AsyncEventWrapper $event
     */
    public function publish(AsyncEventWrapper $event)
    {
        $this->publisher->publish($event->getEvent());
    }
}
