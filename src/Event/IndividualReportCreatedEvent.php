<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Event;

use Kardasz\AMQP\Message\MessageInterface;
use Symfony\Component\EventDispatcher\Event;
use InvalidArgumentException;

/**
 * Class IndividualReportCreatedEvent.
 */
class IndividualReportCreatedEvent extends Event implements AsyncEventInterface
{
    const NAME = 'individual_report.created';

    /**
     * @var string
     */
    private $reportId;

    /**
     * IndividualReportCreatedEvent constructor.
     *
     * @param string $reportId
     */
    public function __construct(string $reportId)
    {
        $this->reportId = $reportId;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return self::NAME;
    }

    /**
     * @return Event
     */
    public function getEvent(): Event
    {
        return $this;
    }

    /**
     * @return array
     */
    public function serialize(): array
    {
        return [
            'reportId' => $this->reportId,
        ];
    }

    /**
     * @param array $data
     *
     * @return MessageInterface
     */
    public static function deserialize(array $data): MessageInterface
    {
        if (!isset($data['reportId'])) {
            throw new InvalidArgumentException('Missing required param "reportId"');
        }

        return new self($data['reportId']);
    }
}
