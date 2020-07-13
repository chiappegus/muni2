<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Form\PersonaType;
use App\Repository\PersonaRepository;
use App\Security\LoginFormAuthenticator;
use App\Service\UploaderHelper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\encodePassword;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

/**
 * @Route("/persona")
 */
class PersonaController extends AbstractController
{
    /**
     * @Route("/", name="persona_index", methods={"GET"})
     */
    public function index(PersonaRepository $personaRepository): Response
    {
        return $this->render('persona/index.html.twig', [
            //'personas'           => $personaRepository->findAll(),
            'personas'           => $personaRepository->findAll(),
            'nombre_controlador' => 'PersonaController',
        ]);
    }

    /**
     * @Route("/new", name="persona_new", methods={"GET","POST"})

     */
    function new (Request $request, PersonaRepository $personaRepository, UploaderHelper $uploaderHelper, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $formAuthenticator): Response{
//dd($em);
        //
        //
        //
        //https://stackoverflow.com/questions/47933339/what-are-exactly-request-attributes
        //dd($this->isGranted('IS_AUTHENTICATED_ANONYMOUSLY'));
        // $aca[] = $request->attributes;
        // $aca[] = $request->attributes->get('user');

        //$request->attributes->set('_route_params', $parameters);
        // dd($request->attributes->get('_route_params'));
        // dd($request->attributes->get('_access_control_attributes')[0]);
        // dd($aca);

        $roless = $request->attributes->get('_access_control_attributes')[0];

        // dd($this->isGranted('IS_AUTHENTICATED_ANONYMOUSLY'));

        //dd('IS_AUTHENTICATED_ANONYMOUSLY' == $aca);

        if (!isset($_GET["persona"])) {

            $persona = new Persona();
        } else {
            $user    = $_GET["persona"];
            $persona = $personaRepository->find($user);

        }

        //dd($user);

        //  dd( $personaRepository->find($user));

        //dd($this->getDoctrine()->getManager());
        //dd($intendente);
        /*
        if ( is_null($persona)) {

        }*/

        //$persona = new Persona();

        //$persona= $pepe;
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /*==============================
            =            images            =
            ==============================*/

            // dd($form['imageFile']->getData());

            //dd($form['imageFile']->getData());
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadArticleImage($uploadedFile);

                $persona->setImageFilename($newFilename);
            }
            //dd($form['password']->getData());
            $persona->setPassword($passwordEncoder->encodePassword(
                $persona,
                $form['password']->getData()
            ));
            /*=====  End of images  ======*/

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($persona);
            $entityManager->flush();

            return $guardHandler->authenticateUserAndHandleSuccess(
                $persona,
                $request,
                $formAuthenticator,
                'main'
            );

            //return $this->redirectToRoute('persona_index');
        }

        return $this->render('persona/new.html.twig', [
            'persona' => $persona,
            'form'    => $form->createView(),
        ]);
    }

/**
 * @Route("/{id}", name="persona_show", methods={"GET"})
 */
    public function show(Persona $persona): Response
    {
        return $this->render('persona/show.html.twig', [
            'persona' => $persona,
        ]);
    }

/**
 * @Route("/{id}/edit", name="persona_edit", methods={"GET","POST"})
 */
    public function edit(Request $request, Persona $persona, UploaderHelper $uploaderHelper): Response
    {

        /* $roles = $persona->getRoles();
        $roles[] = 'ROLE_RODOLFO';
        array_unique($roles);
        $persona->setRoles($roles);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($persona);
        $entityManager->flush();*/

        // dd($this->getUser()->getId(), $persona->getId());
        //dd($persona->getId() === $this->getUser()->getId());

        //dd($persona->getId() === $this->getUser()->getId());

        /*==================================================
        =            se va a cambiar por voters            =
        ==================================================*/

        // if (($persona->getId() != $this->getUser()->getId()) && (!$this->isGranted('ROLE_SUPRA'))) {
        //     throw $this->createAccessDeniedException('No access!'); }

        /*=====  End of se va a cambiar por voters  ======*/

        /*==============================
        =            voters            =
        ==============================*/

        if (!$this->isGranted('MANAGE', $persona)) {
            throw $this->createAccessDeniedException('No access!');
        }

        /*=====  End of voters  ======*/

        // if ($persona->getId() != $this->getUser()->getId() && !$this->isGranted('ROLE_ADMIN')) {
        //     throw $this->createAccessDeniedException('No access!');
        // }

        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //dd($form);

            /*==============================
            =            images            =
            ==============================*/

            // dd($form['imageFile']->getData());

            //dd($form['imageFile']->getData());
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadArticleImage($uploadedFile);

                $persona->setImageFilename($newFilename);
            }
            /*=====  End of images  ======*/

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('persona_index');
        }

        return $this->render('persona/edit.html.twig', [
            'persona' => $persona,
            'form'    => $form->createView(),
        ]);
    }

/**
 * @Route("/{id}", name="persona_delete", methods={"DELETE"})
 * @IsGranted("MANAGE", subject="persona")
 */
    public function delete(Request $request, Persona $persona): Response
    {

        if ($this->isCsrfTokenValid('delete' . $persona->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($persona);
            $entityManager->flush();

        }

        // dd($persona);
        //http://jonsegador.com/2012/03/error-con-symfony2-you-cannot-refresh-a-user-from-the-entityuserprovider-that-does-not-contain-an-identifier/
        /*----------  solo lo deberia hacer un user auth y no uno
        directo ----------*/

        return $this->redirect($this->generateUrl('persona_index'));}

    /*----------  proximo https://hugo-soltys.com/blog/easily-implement-facebook-login-with-symfony-4  ----------*/

}
