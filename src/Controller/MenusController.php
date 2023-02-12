<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenusController extends AbstractController
{
    #[Route('/menus', name: 'app_menus')]
    public function index(): Response
    {
        return $this->render('pages/menus.html.twig', [
            'controller_name' => 'MenusController',
        ]);
    }
}
