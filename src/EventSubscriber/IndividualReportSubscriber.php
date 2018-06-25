<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\EventSubscriber;

use Kardasz\Event\IndividualReportCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class IndividualReportSubscriber
 * @package Kardasz\EventSubscriber
 */
class IndividualReportSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            IndividualReportCreatedEvent::NAME => [
                ['notify', 10]
            ]
        ];
    }

    /**
     * @param IndividualReportCreatedEvent $event
     */
    public function notify(IndividualReportCreatedEvent $event)
    {
        // todo: for example notify some that report was created
    }
}
