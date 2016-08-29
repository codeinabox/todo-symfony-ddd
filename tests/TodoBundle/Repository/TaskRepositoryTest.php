<?php

namespace test\TodoBundle\Repository;

use TodoBundle\Repository\TaskRepository;
use Todo\Entity\Task;
use Todo\Repository\TaskRepository as TaskRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * @author Mathew Attlee <hello@codeinabox.com>
 */
class TaskRepositoryTest extends \PHPUnit_Framework_TestCase
{
    private $emProphet;
    private $repository;

    public function testShouldImplementDomainInterface()
    {
        $this->assertInstanceOf(TaskRepositoryInterface::class, $this->repository);
    }

    public function testShouldPersistTaskOnAdd()
    {
        $task = $this->prophesize(Task::class);
        $this->emProphet->persist($task)->shouldBeCalled();
        $this->emProphet->flush()->shouldBeCalled();
        $this->repository->add($task->reveal());
    }

    protected function setUp()
    {
        $this->emProphet = $this->prophesize(EntityManager::class);
        $classMetadata = new ClassMetadata(Task::class);
        $this->repository = new TaskRepository($this->emProphet->reveal(), $classMetadata);
    }
}
