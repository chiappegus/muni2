<?php

namespace App\Controller;

use App\Entity\Buffy;
use App\Form\BuffyType;
use App\Repository\BuffyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/buffy")
 */
class BuffyController extends AbstractController
{
    /**
     * @Route("/", name="buffy_index", methods={"GET"})
     */
    public function index(BuffyRepository $buffyRepository): Response
    {
        return $this->render('buffy/index.html.twig', [
            'buffies' => $buffyRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="buffy_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $buffy = new Buffy();
        $form = $this->createForm(BuffyType::class, $buffy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($buffy);
            $entityManager->flush();

            return $this->redirectToRoute('buffy_index');
        }

        return $this->render('buffy/new.html.twig', [
            'buffy' => $buffy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="buffy_show", methods={"GET"})
     */
    public function show(Buffy $buffy): Response
    {
        return $this->render('buffy/show.html.twig', [
            'buffy' => $buffy,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="buffy_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Buffy $buffy): Response
    {
        $form = $this->createForm(BuffyType::class, $buffy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('buffy_index');
        }

        return $this->render('buffy/edit.html.twig', [
            'buffy' => $buffy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="buffy_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Buffy $buffy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$buffy->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($buffy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('buffy_index');
    }
}
