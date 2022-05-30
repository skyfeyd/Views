<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(PostRepository $postRepository): Response
    {

        $posts = $postRepository->findAll();

        return $this->render('main/index.html.twig', [
            'posts' => $posts,
            'controller_name' => 'MainController',
        ]);
    }
}