<?php

namespace App\Controller;

use App\Form\BottleType;
use App\Repository\BottleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Bottle;
use App\Form\BottleSearchType;

class BottleController extends AbstractController
{
    #[Route('', name: 'app_bottle')]
    public function index(BottleRepository $bottleRepository, Request $request): Response
    {
        $form = $this->createForm(BottleSearchType::class);
        $form ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bottles = $bottleRepository->findBy([
                'region' => $form->getData()["region"],
            ]);
        } else {
            $bottles = $bottleRepository->findAll();
        }

        return $this->render('bottle/index.html.twig', [
            'bottles' => $bottles,
            'searchForm' => $form,
        ]);
    }

    
    #[Route('/new', name: 'app_bottle_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(BottleType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($form->getData());
            $em->flush();
            return $this->redirectToRoute('app_bottle');
        }

        return $this->render('bottle/new.html.twig', [
           'BottleForm' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bottle_edit')]
    public function edit(Bottle $bottle, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(BottleType::class, $bottle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->flush();
            return $this->redirectToRoute('app_bottle');
        }

        return $this->render('bottle/edit.html.twig', [
           'BottleForm' => $form,
           'bottle' => $bottle,
        ]);
    }
    #[Route('/{id}/delete', name: 'app_bottle_delete')]
    public function delete(Bottle $bottle, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(BottleType::class, $bottle);
        $form->handleRequest($request);

        $em->remove($bottle);      
            $em->flush();

            return $this->redirectToRoute('app_bottle');
    }
}
