<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\AMQP\Publisher;

use Kardasz\AMQP\Message\MessageInterface;

/**
 * Interface MessagePublisherInterface.
 */
interface MessagePublisherInterface
{
    /**
     * @param MessageInterface $message
     */
    public function publish(MessageInterface $message): void;
}
