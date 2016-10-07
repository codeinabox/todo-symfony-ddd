<?php

namespace TodoBundle\DTO;

use Todo\Entity\Task;

class TaskDTO
{
    /** @var int */
    public $id;

    /** @var string */
    public $description;

    public function __construct(Task $entity)
    {
        $this->id = $entity->getId();
        $this->description = $entity->getDescription();
    }
}
