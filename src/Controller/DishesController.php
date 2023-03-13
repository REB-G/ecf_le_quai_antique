<?php

namespace App\Controller;

use App\Entity\Dishes;
use App\Form\DishesType;
use App\Repository\DishesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dishes')]
class DishesController extends AbstractController
{
    #[Route('/', name: 'app_dishes_index', methods: ['GET'])]
    public function index(DishesRepository $dishesRepository): Response
    {
        return $this->render('dishes/index.html.twig', [
            'dishes' => $dishesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dishes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, DishesRepository $dishesRepository): Response
    {
        $dish = new Dishes();
        $form = $this->createForm(DishesType::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dishesRepository->save($dish, true);

            return $this->redirectToRoute('app_dishes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dishes/new.html.twig', [
            'dish' => $dish,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dishes_show', methods: ['GET'])]
    public function show(Dishes $dish): Response
    {
        return $this->render('dishes/show.html.twig', [
            'dish' => $dish,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dishes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Dishes $dish, DishesRepository $dishesRepository): Response
    {
        $form = $this->createForm(DishesType::class, $dish);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dishesRepository->save($dish, true);

            return $this->redirectToRoute('app_dishes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('dishes/edit.html.twig', [
            'dish' => $dish,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dishes_delete', methods: ['POST'])]
    public function delete(Request $request, Dishes $dish, DishesRepository $dishesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dish->getId(), $request->request->get('_token'))) {
            $dishesRepository->remove($dish, true);
        }

        return $this->redirectToRoute('app_dishes_index', [], Response::HTTP_SEE_OTHER);
    }
}
