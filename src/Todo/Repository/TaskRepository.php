<?php

namespace Todo\Repository;

use Todo\Entity\Task;

/**
 * Interface TaskRepository
 * @author Mathew Attlee <hello@codeinabox.com>
 */
interface TaskRepository
{
    /**
     * @param Task $task
     */
    public function add(Task $task);

    /**
     * @return Task
     */
    public function findById($taskId);

    /**
     * @return array
     */
    public function findAllComplete();

    /**
     * @return array
     */
    public function findAllIncomplete();
}
