<?php

namespace App\Controller;

use App\Entity\Emploi;
use App\Form\EmploiType;
use App\Repository\EmploiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/emploi')]
class EmploiController extends AbstractController
{
    #[Route('/', name: 'app_emploi_index', methods: ['GET'])]
    public function index(EmploiRepository $emploiRepository): Response
    {
        return $this->render('emploi/index.html.twig', [
            'emplois' => $emploiRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_emploi_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EmploiRepository $emploiRepository): Response
    {
        $emploi = new Emploi();
        $form = $this->createForm(EmploiType::class, $emploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emploiRepository->add($emploi, true);

            return $this->redirectToRoute('app_emploi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('emploi/new.html.twig', [
            'emploi' => $emploi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_emploi_show', methods: ['GET'])]
    public function show(Emploi $emploi): Response
    {
        return $this->render('emploi/show.html.twig', [
            'emploi' => $emploi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_emploi_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Emploi $emploi, EmploiRepository $emploiRepository): Response
    {
        $form = $this->createForm(EmploiType::class, $emploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emploiRepository->add($emploi, true);

            return $this->redirectToRoute('app_emploi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('emploi/edit.html.twig', [
            'emploi' => $emploi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_emploi_delete', methods: ['POST'])]
    public function delete(Request $request, Emploi $emploi, EmploiRepository $emploiRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$emploi->getId(), $request->request->get('_token'))) {
            $emploiRepository->remove($emploi, true);
        }

        return $this->redirectToRoute('app_emploi_index', [], Response::HTTP_SEE_OTHER);
    }
}