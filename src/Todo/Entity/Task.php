<?php

namespace Todo\Entity;

use Todo\Exception\TaskAlreadyCompletedException;

class Task
{
    private $id;
    private $description;
    private $completed;

    /**
     * @param string $description
     */
    public function __construct($description)
    {
        $this->description = $description;
        $this->completed = false;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function isCompleted()
    {
        return $this->completed;
    }

    public function complete()
    {
        if ($this->isCompleted()) {
            throw new TaskAlreadyCompletedException();
        }

        $this->completed = true;
    }
}
