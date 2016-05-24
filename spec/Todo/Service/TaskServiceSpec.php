<?php

namespace spec\Todo\Service;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Todo\Repository\TaskRepository;
use Todo\Entity\Task;
use Todo\Exception\TaskNotFoundException;

class TaskServiceSpec extends ObjectBehavior
{
    function it_creates_new_task(TaskRepository $repository)
    {
        $this->beConstructedWith($repository);
        $repository->add(Argument::type(Task::class))->shouldBeCalled();
        $this->create("New task")->shouldHaveType(Task::class);
    }

    function it_marks_task_as_completed(TaskRepository $repository, Task $task)
    {
        $this->beConstructedWith($repository);
        $repository->findById('123')->willReturn($task);
        $task->complete()->shouldBeCalled();
        $this->markComplete('123')->shouldEqual($task);
    }

    function it_errors_if_completing_nonexistent_task(TaskRepository $repository)
    {
        $this->beConstructedWith($repository);
        $repository->findById('123')->willReturn(null);
        $this->shouldThrow(TaskNotFoundException::class)->duringMarkComplete('123');
    }

    function it_lists_incomplete_tasks(TaskRepository $repository, Task $task)
    {
        $this->beConstructedWith($repository);
        $expectedTasks = [$task];
        $repository->findAllIncomplete()->willReturn($expectedTasks);
        $this->incompleteTasks()->shouldEqual($expectedTasks);
    }

    function it_lists_complete_tasks(TaskRepository $repository, Task $task)
    {
        $this->beConstructedWith($repository);
        $expectedTasks = [$task];
        $repository->findAllComplete()->willReturn($expectedTasks);
        $this->completeTasks()->shouldEqual($expectedTasks);
    }
}
