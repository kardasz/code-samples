<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\AMQP\Message;

/**
 * Interface MessageInterface
 * @package Kardasz\AMQP\Message
 */
interface MessageInterface
{
    /**
     * @return array
     */
    public function serialize() : array;

    /**
     * @param array $data
     * @return MessageInterface
     */
    public static function deserialize(array $data) : MessageInterface;
}
