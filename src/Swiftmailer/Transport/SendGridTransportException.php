<?php
/**
 * Code Samples
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */

namespace Kardasz\Swiftmailer\Transport;

use Exception;
use SendGrid\Response;
use Swift_TransportException;

/**
 * Class SendGridTransportException
 * @package Kardasz\Swiftmailer\Transport
 */
class SendGridTransportException extends Swift_TransportException
{
    /**
     * @var null|Response
     */
    private $response;

    /**
     * SendGridTransportException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     * @param null|Response $response
     */
    public function __construct(string $message, int $code = 0, ?Exception $previous = null, ?Response $response = null)
    {
        parent::__construct($message, $code, $previous);
        $this->response = $response;
    }

    /**
     * @return null|Response
     */
    public function getResponse(): ?Response
    {
        return $this->response;
    }
}
