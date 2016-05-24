<?php

namespace spec\Todo\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Todo\Exception\TaskAlreadyCompletedException;

class TaskSpec extends ObjectBehavior
{
    function it_should_have_a_description()
    {
        $this->getDescription()->shouldEqual('Write more specs');
    }

    function it_should_not_be_completed()
    {
        $this->shouldNotBeCompleted();
    }

    function it_should_mark_as_completed()
    {
        $this->complete();
        $this->shouldBeCompleted();
    }

    function it_should_not_be_completed_twice()
    {
        $this->complete();
        $this->shouldThrow(TaskAlreadyCompletedException::class)->duringComplete();
    }

    function let()
    {
        $this->beConstructedWith('Write more specs');
    }
}
