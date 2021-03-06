<?php

namespace TodoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TodoBundle\DTO\TaskDTO;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $taskService = $this->container->get('todo.task_service');
        $completeTasks = $this->transformToDTOs($taskService->completeTasks());
        $incompleteTasks = $this->transformToDTOs($taskService->incompleteTasks());
        return $this->render(
            'TodoBundle:Default:index.html.mustache',
            [
                'completeTasks' => $completeTasks,
                'hasCompleteTasks' => count($completeTasks) !== 0,
                'incompleteTasks' => $incompleteTasks,
                'hasIncompleteTasks' => count($incompleteTasks) !== 0
            ]
        );
    }

    /**
     * @Route("/task", name="addTask")
     * @Method({"POST"})
     */
    public function addTaskAction(Request $request)
    {
        $description = strip_tags($request->request->get("description"));
        $taskService = $this->container->get('todo.task_service');
        $taskService->create($description);

        return $this->redirectToRoute('homepage', array(), 301);
    }

    /**
     * @Route("/complete/{id}")
     */
    public function completeAction($id)
    {
        $taskService = $this->container->get('todo.task_service');
        $taskService->markComplete($id);

        return $this->redirectToRoute('homepage', array(), 301);
    }

    private function transformToDTOs($collection)
    {
        $dtos = [];
        foreach ($collection as $task) {
            $dtos[] = new TaskDTO($task);
        }
        return $dtos;
    }
}
