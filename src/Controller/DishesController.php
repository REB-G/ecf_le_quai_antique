<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishesController extends AbstractController
{
    #[Route('/carte', name: 'app_dishes')]
    public function index(): Response
    {
        return $this->render('pages/dishes.html.twig', [
            'controller_name' => 'DishesController',
        ]);
    }
}
