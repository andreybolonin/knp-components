<?php

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Test\Tool\BaseTestCase;
use Knp\Component\Pager\Event\Subscriber\Paginate\PaginationSubscriber;
use Knp\Component\Pager\Event\BeforeEvent;

class PaginationSubscriberTest extends BaseTestCase
{
    /**
     * @test
     */
    function shouldRegisterExpectedSubscribersOnlyOnce()
    {
        $dispatcher = $this->getMockBuilder(EventDispatcherInterface::class)->getMock();
        $dispatcher->expects($this->exactly(12))->method('addSubscriber');

        $subscriber = new PaginationSubscriber();

        $beforeEvent = new BeforeEvent($dispatcher);
        $subscriber->before($beforeEvent);

        // Subsequent calls do not add more subscribers
        $subscriber->before($beforeEvent);
    }
}