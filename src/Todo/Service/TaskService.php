<?php

namespace Todo\Service;

use Todo\Repository\TaskRepository;
use Todo\Entity\Task;
use Todo\Exception\TaskNotFoundException;

/**
 * Class TaskService
 * @author Mathew Attlee <hello@codeinabox.com>
 */
class TaskService
{
    private $repository;

    /**
     * @param TaskRepository $repository
     */
    public function __construct(TaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @var string $description
     */
    public function create($description)
    {
        $task = new Task($description);
        $this->repository->add($task);
        return $task;
    }

    /**
     * @var string $taskId
     */
    public function markComplete($taskId)
    {
        $task = $this->repository->findById($taskId);
        if (!$task) {
            throw new TaskNotFoundException("No task found with $taskId");
        }
        $task->complete();
        $this->repository->update($task);
        return $task;
    }

    /**
     * @return array
     */
    public function completeTasks()
    {
        return $this->repository->findAllComplete();
    }

    /**
     * @return array
     */
    public function incompleteTasks()
    {
        return $this->repository->findAllIncomplete();
    }
}
