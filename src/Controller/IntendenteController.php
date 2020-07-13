<?php

namespace App\Controller;

use App\Entity\Intendente;
use App\Form\IntendenteType;
use App\Repository\IntendenteRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/intendente")
 * @IsGranted("ROLE_USER")
 */
class IntendenteController extends AbstractController
{
    /**
     * @Route("/", name="intendente_index", methods={"GET"})
     */
    public function index(IntendenteRepository $intendenteRepository): Response
    {
        return $this->render('intendente/index.html.twig', [
            'intendentes' => $intendenteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="intendente_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    function new (Request $request): Response{
        /*==================================================
        =            permisos sobre controllers            =
        ==================================================*/

        // $this->denyAccessUnlessGranted('ROLE_ADMIN');

        /*=====  End of permisos sobre controllers  ======*/

        $intendente = new Intendente();
        $form       = $this->createForm(IntendenteType::class, $intendente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /*==============================================================================================================================================
            =            aca seguro tengo que hacer una funcion
            para detectar si el intendente ya tiene cargado el DNI            =
            ==============================================================================================================================================*/

            /*=====  End of aca seguro tengo que hacer una funcion   ======*/

            // dd($form->getdata());
            $persona = $intendente->getRelation();
            //dd(   $persona-> getId() );
            //

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($intendente);
            $entityManager->flush();

            return $this->redirectToRoute('persona_new', ['persona' => $persona->getId()]);
            /*mio*/
            /*
             */
            // return $this->redirectToRoute('intendente_index');
        }

        return $this->render('intendente/new.html.twig', [
            'intendente' => $intendente,
            'form'       => $form->createView(),
        ]);
        die();
    }

    /**
     * @Route("/news", name="intendente_news", methods={"GET","POST"})
     */
    public function news(Request $request): Response
    {
        $intendente = new Intendente();
        $form       = $this->createForm(IntendenteType::class, $intendente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /*==============================================================================================================================================
            =            aca seguro tengo que hacer una funcion
            para detectar si el intendente ya tiene cargado el DNI            =
            ==============================================================================================================================================*/

            /*=====  End of aca seguro tengo que hacer una funcion   ======*/

            // dd($form->getdata());
            $persona = $intendente->getRelation();
            //dd(   $persona-> getId() );
            //

            return $this->redirectToRoute('persona_new', ['persona' => $persona->getId()]);
            /*mio*/
            /*    $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($intendente);
            $entityManager->flush();
             */
            // return $this->redirectToRoute('intendente_index');
        }

        return $this->render('intendente/news.html.twig', [
            'intendente' => $intendente,
            'form'       => $form->createView(),
        ]);
        die();
    }

    /**
     * @Route("/{id}", name="intendente_show", methods={"GET"})
     */
    public function show(Intendente $intendente): Response
    {

        $persona = $intendente->getRelation();
        /* dump($persona->getDni());
        dump($persona->getNombre());
        dump($persona->getApellido());*/

        //die();
        return $this->render('intendente/show.html.twig', [
            'intendente' => $intendente,
            'persona'    => $persona,
        ]);
        //die();
    }

    /**
     * @Route("/{id}/edit", name="intendente_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Intendente $intendente): Response
    {
        //dd($intendente);
        $form = $this->createForm(IntendenteType::class, $intendente);
        $form->handleRequest($request);
        //dd($intendente-> getId() );
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('intendente_index');
        }

        return $this->render('intendente/edit.html.twig', [
            'intendente' => $intendente,
            'form'       => $form->createView(),
        ]);
        die();
    }

    /**
     * @Route("/{id}", name="intendente_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Intendente $intendente): Response
    {
        if ($this->isCsrfTokenValid('delete' . $intendente->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($intendente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('intendente_index');
        die();
    }
}
