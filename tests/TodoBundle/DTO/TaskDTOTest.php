<?php

namespace Tests\TodoBundle\DTO;

use Todo\Entity\Task;
use TodoBundle\DTO\TaskDTO;

class TaskDTOTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldGetValuesFromEntity()
    {
        $taskObserver = $this->prophesize(Task::class);
        $taskObserver->getId()->willReturn(123);
        $taskObserver->getDescription()->willReturn('Buy milk');

        $dto = new TaskDTO($taskObserver->reveal());
        $this->assertEquals(123, $dto->id);
        $this->assertEquals('Buy milk', $dto->description);
    }
}
