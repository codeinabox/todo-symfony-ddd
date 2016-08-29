<?php

namespace TodoBundle\Repository;

use Todo\Entity\Task;
use Todo\Repository\TaskRepository as TaskRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class TaskRepository extends EntityRepository implements TaskRepositoryInterface
{
    public function add(Task $task)
    {
        $this->getEntityManager()->persist($task);
        $this->getEntityManager()->flush();
    }

    public function update(Task $task)
    {
        $this->getEntityManager()->flush();
    }

    /**
     * @return Task
     */
    public function findById($taskId)
    {
        return $this->findOneById($taskId);
    }

    public function findAllComplete()
    {
        return $this->findBy(['completed' => true]);
    }

    public function findAllIncomplete()
    {
        return $this->findBy(['completed' => false]);
    }
}
