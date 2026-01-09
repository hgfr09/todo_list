<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(name:'task_')]
final class TaskController extends AbstractController
{
    #[Route('', name: 'index')] //--> task_index
    public function index(TaskRepository $repo): Response
    {
        return $this->render('task/index.html.twig', [
           'tasks'=>$repo->findAll()
        ]);
    }

    #[Route('tasks/{id}', name:'show')] // task_show
    public function show(Task $task) : Response{
        return $this->render('task/show.html.twig', [
            'task'=>$task
        ]);
    }
}
