<?php

namespace App\Controller;

use App\Entity\ComidaPreferidad;
use App\Form\ComidaPreferidadType;
use App\Repository\ComidaPreferidadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comida/preferidad")
 */
class ComidaPreferidadController extends AbstractController
{
    /**
     * @Route("/", name="comida_preferidad_index", methods={"GET"})
     */
    public function index(ComidaPreferidadRepository $comidaPreferidadRepository): Response
    {
        return $this->render('comida_preferidad/index.html.twig', [
            'comida_preferidads' => $comidaPreferidadRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="comida_preferidad_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $comidaPreferidad = new ComidaPreferidad();
        $form = $this->createForm(ComidaPreferidadType::class, $comidaPreferidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comidaPreferidad);
            $entityManager->flush();

            return $this->redirectToRoute('comida_preferidad_index');
        }

        return $this->render('comida_preferidad/new.html.twig', [
            'comida_preferidad' => $comidaPreferidad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comida_preferidad_show", methods={"GET"})
     */
    public function show(ComidaPreferidad $comidaPreferidad): Response
    {
        return $this->render('comida_preferidad/show.html.twig', [
            'comida_preferidad' => $comidaPreferidad,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="comida_preferidad_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ComidaPreferidad $comidaPreferidad): Response
    {
        $form = $this->createForm(ComidaPreferidadType::class, $comidaPreferidad);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('comida_preferidad_index');
        }

        return $this->render('comida_preferidad/edit.html.twig', [
            'comida_preferidad' => $comidaPreferidad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="comida_preferidad_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ComidaPreferidad $comidaPreferidad): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comidaPreferidad->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($comidaPreferidad);
            $entityManager->flush();
        }

        return $this->redirectToRoute('comida_preferidad_index');
    }
}
