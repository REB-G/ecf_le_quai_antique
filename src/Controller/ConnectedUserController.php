<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConnectedUserController extends AbstractController
{
    #[Route('/compte', name: 'app_connected_user')]
    public function index(): Response
    {
        return $this->render('connected_user/index.html.twig', [
            'controller_name' => 'ConnectedUserController',
        ]);
    }
}
