<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\AMQP\Consumer;

use Kardasz\AMQP\Message\MessageInterface;

/**
 * Interface MessageConsumerInterface.
 */
interface MessageConsumerInterface
{
    /**
     * @param MessageInterface $message
     *
     * @return bool
     */
    public function consume(MessageInterface $message): bool;
}
