<?php
/**
 * Code Samples.
 *
 * @author Krzysztof Kardasz <krzysztof@kardasz.eu>
 * @license MIT
 */
namespace Kardasz\Tests\Swiftmailer;

use Kardasz\Swiftmailer\Transport\SendGridTransport;
use PHPUnit\Framework\TestCase;
use Mockery;
use SendGrid;
use SendGrid\Response;
use Swift_Events_SimpleEventDispatcher;
use Swift_Message;

/**
 * Class SendGridTransportTest.
 */
class SendGridTransportTest extends TestCase
{
    /**
     * @test
     *
     * @throws \Kardasz\Swiftmailer\Transport\SendGridTransportException
     * @throws \Swift_DependencyException
     */
    public function it_sends_email_by_send_grid_transport()
    {
        $sendgrid = Mockery::mock(SendGrid::class);

        $sendgrid
            ->shouldReceive('send')
            ->andReturn(new Response(202));

        $transport = new SendGridTransport($sendgrid, new Swift_Events_SimpleEventDispatcher());
        $count = $transport->send(
            (new Swift_Message())
                ->setSubject('Your subject')
                ->setFrom(['john@doe.com' => 'John Doe'])
                ->setTo(['receiver@domain.org', 'other@domain.org' => 'A name'])
                ->setBody('Here is the message itself')
        );

        $this->assertEquals(2, $count);
    }

    public function tearDown()
    {
        Mockery::close();
    }
}
