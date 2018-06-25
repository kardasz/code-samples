<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\AMQP\Serializer;

use Kardasz\AMQP\Message\MessageInterface;

/**
 * Interface MessageSerializerInterface
 * @package Kardasz\AMQP\Serializer
 */
interface MessageSerializerInterface
{
    /**
     * @param MessageInterface $message
     * @return string
     */
    public function serialize(MessageInterface $message): string;

    /**
     * @param string $data
     * @return MessageInterface|null
     */
    public function deserialize(string $data): MessageInterface;
}
