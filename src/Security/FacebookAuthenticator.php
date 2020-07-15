<?php

namespace App\Security;

use App\Entity\Persona;
use App\Repository\PersonaRepository;
use KnpU\OAuth2ClientBundle\Client\getAccessToken;
use KnpU\OAuth2ClientBundle\Client\Provider\FacebookClient;
use KnpU\OAuth2ClientBundle\Security\Helper\FinishRegistrationBehavior;
use KnpU\OAuth2ClientBundle\Security\Helper\PreviousUrlHelper;
use KnpU\OAuth2ClientBundle\Security\Helper\SaveAuthFailureMessage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class FacebookAuthenticator extends AbstractGuardAuthenticator
{
    use FinishRegistrationBehavior;
    use PreviousUrlHelper;
    use SaveAuthFailureMessage;

    private $userRepository;
    private $router;

    private $passwordEncoder;
    private $usuarios;

    /**
     * @var Facebook
     */
    private $facebookClient;

    public function __construct(PersonaRepository $userRepository, RouterInterface $router, FacebookClient $facebookClient)
    {
        $this->facebookClient = $facebookClient;
        $this->userRepository = $userRepository;
        $this->router         = $router;

    }

    public function supports(Request $request)
    {
        // todo

        return $request->attributes->get('_route') === 'connect_facebook_check';
    }

    public function getCredentials(Request $request)
    {
        //dd($request->getPathInfo());
        if ($request->getPathInfo() != '/connect/facebook/check') {
            // skip authentication unless we're on this URL!
            return null;
        }
        //dd($this->facebookClient);
        // EAAH09CWDZAjsBAB9LrBz0wDHDlGNazCM71e48br0ZB4YfLnkmXoaTjCzRNmYTMuP1uaHvTSMj9w0nRQSCsP67OCfVXTzTkqnabYpHdccWM2OUSiHTp0cxlFnt3yrhf0y3hTUKxFNIUXOPEqLs2I6mssUuKEUxh1IBbYZCqLNgZDZD
        // dd($this->facebookClient->getAccessToken($request));

        /*==============================================================
        =            por el momento consigue el toqken bear            =
        ==============================================================*/
        // dd($this->facebookClient->getAccessToken($request));

        // dd($this->facebookClient->fetchUserFromToken($this->facebookClient->getAccessToken()));

        // dd($request, $this->facebookClient->getAccessToken());
        //dd($this->facebookClient->getAccessToken());
        //$this->facebookClient
        //AccessToken.getCurrentAccessToken()
        //            League\OAuth2\Client\Token\AccessToken {#7788 ▼
        //   #accessToken: "EAAH09CWDZAjsBACSqEXi14OE5P5eJo7bYi4F5ZClOFPvi19pFrVLdvt0Hfuo6zSckGL70UR3CyupaLOqIXb05nfio9OhZAt7rGZA6B6iwA7ubhCMD4Qs9G2q8pY7PZC4z1PnKHAJvN4jwa9dKkwBsKJvDWJjmxl ▶"
        //   #expires: 1599869226
        //   #refreshToken: null
        //   #resourceOwnerId: null
        //   #values: array:1 [▼
        //     "token_type" => "bearer"
        //   ]0.21
        // }

        /*=====  End of por el momento consigue el toqken bear  ======*/

        //return $this->facebookClient->getAccessToken($request);
        // return $this->facebookClient->getAccessToken();

        //return $this->fetchAccessToken($this->getFacebookClient());
        try {
            return $this->facebookClient->getAccessToken();
        } catch (IdentityProviderException $e) {
            // you could parse the response to see the problem
            throw $e;
        }
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        //dd($userProvider);
        //dd($credentials);
        //dd('caca', $facebookUser = $this->getFacebookClient());
        //dd($this->facebookClient->fetchUserFromToken($credentials));

        /** @var FacebookUser $facebookUser */
        //$facebookUser = $this->getFacebookClient($credentials);

        $facebookUser = $this->facebookClient->fetchUserFromToken($credentials);

        if ($this->userRepository->findOneBy(['IdFacebook' => $facebookUser->getid()]) == null) {

            //  return new RedirectResponse($facebookUser);
            //return false;
            // dd($credentials);
            // return new JsonResponse($facebookUser);
            # code...

        }
        // dd($this->userRepository->findOneBy(['IdFacebook' => $facebookUser->getid()]) == null);
        $email = $facebookUser->getEmail();

        $id             = $facebookUser->getid();
        $nombreCompleto = $facebookUser->getName();
        $nombre         = $facebookUser->getFirstName();
        $apellido       = $facebookUser->getLastName();
        $Imagen         = $facebookUser->getPictureUrl();

        // dd($id, $facebookUser, $email, $id, $nombreCompleto, $nombre, $apellido,
        // $Imagen, $this->userRepository->findOneBy(['email' => 'gust0@gus.com']));

        // $token = new CsrfToken('authenticate_gustavo', $credentials['csrf_token']);
        // if (!$this->csrfTokenManager->isTokenValid($token)) {
        //     throw new InvalidCsrfTokenException();
        // }

        // if (!$this->csrfTokenManager->isTokenValid($token)) {
        //     throw new InvalidCsrfTokenException();
        // }
        // return $this->userRepository->findOneBy(['IdFacebook' => $facebookUser->getid()]);
        // if (null === $user) {throw new UsernameNotFoundException(sprintf('Null returned from %s::getUser()', \get_class($guardAuthenticator)));}
        $pepe = new Persona();
        $pepe->getNombre($facebookUser->getFirstName());
        $pepe->getEmail($facebookUser->getFirstName());
        $pepe->getApellido($facebookUser->getLastName());
        $pepe->getImageFilename($facebookUser->getPictureUrl());
        $pepe->getIdFacebook($facebookUser->getid());

        //$this->userManager->updateUser($pepe);
        //$entityManager = $this->getDoctrine()->getManager();
        //fetchUser()
        //dd($this->facebookClient->fetchUser());
        // return $this->facebookClient->fetchUser();
        //return $userProvider->loadUserByUsername($pepe);
        return $pepe;

        //loadUserByUsername($username)
        //dd($userProvider->loadUserByUsername($pepe));

        //return $userProvider->loadUserByUsername($pepe->getUsername());

        //$entityManager->flush();
        //$this->em->getDoctrine()->getManager()->persist($pepe);
        // $entityManager->persist($persona);
        //$this->em->copy($pepe);
        //return new RedirectResponse($this->router->generate('persona_new'));
        // dd($request->getUser());
        // $pepe->setNombre($facebookUser->getid());
        //return $pepe;
        //return new RedirectResponse($this->router->generate('persona_new'));

    }

    public function checkCredentials($credentials, UserInterface $user)
    {

        $facebookUser = $this->facebookClient->fetchUserFromToken($credentials);
        //return new RedirectResponse($this->router->generate('app_login'));persona_index
        //return new RedirectResponse($this->router->generate('persona_new'));
        //$user = new Persona($pepe);
        // return $this->render('persona/new.html.twig', [
        //     'persona' => $user,
        //     'form'    => $form->createView(),
        // ]);
        // dd('aca', $facebookUser->getid(), $facebookUser->getName());
        //dd('aca');
        // todo

        $persona = new Persona($user);
        $persona->setNombre($facebookUser->getName());
        $persona->setApellido($facebookUser->getLastName());

        //$userProvider->loadUserByUsername($persona->getUsername());

        //return new RedirectResponse($this->router->generate('persona_new'));
        //return new RedirectResponse($this->router->generate('persona_new'));
        // return $pepe;
        //return new RedirectResponse($this->router->generate('app_login'))
        // only needed if we need to check a password - we'll do that later!
        // return new RedirectResponse($this->router->generate('persona_new'));
        // return $user;
        //return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
        // return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
        return false;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        //dd($this->facebookClient->fetchUser());

        //dd($this->facebookClient->fetchUserFromToken($credentials));
        //$facebookUser = $this->facebookClient->fetchUserFromToken($credentials);
        // dd($user);
        // return new RedirectResponse($this->router->generate('persona_new'));
        //dd($this->facebookClient);
        // dd($this->userRepository->findOneBy(['IdFacebook' => $facebookUser->getid()]));
        //dd('aca', $pepe);
        // return new RedirectResponse($this->router->generate('persona_new'));
        //dd($request);

        // return null;

        // return new JsonResponse(['result' => $exception->getMessage()], 401);
        //  return new JsonResponse(['result' => $exception->getMessage()], 401);

        // dd($request, $exception);
        //<div>{{ error.messageKey|trans(error.messageData, 'security') }}</div>
        $error = [
            // you may want to customize or obfuscate the message first
            'messageKey' => strtr($exception->getMessageKey(), $exception->getMessageData()),

            // or to translate this message
            // $this->translator->trans($exception->getMessageKey(), $exception->getMessageData())
        ];

        /*   $error = ['error' => ['messageKey' => $exception->getMessageKey(),
        'messageData'

        => $exception->getMessageData()]];*/

        if ($request->hasSession()) {
            $request->getSession()->set(Security::AUTHENTICATION_ERROR,
                $exception);
        };

        //return new JsonResponse($error, Response::HTTP_UNAUTHORIZED);
        // return new JsonResponse($error, Response::HTTP_UNAUTHORIZED);
        $facebookUser = $this->facebookClient->fetchUser();
        $pepe         = new Persona();
        $pepe->setNombre($facebookUser->getFirstName());
        $pepe->setEmail($facebookUser->getEmail());
        $pepe->setApellido($facebookUser->getLastName());
        $pepe->setImageFilename($facebookUser->getPictureUrl());
        $pepe->setIdFacebook($facebookUser->getid());

        return new RedirectResponse($this->router->generate('facebook', [
            'facebook' => [
                'nombre'      => $facebookUser->getFirstName(),
                'email'       => $facebookUser->getEmail(),
                'apellido'    => $facebookUser->getLastName(),
                'foto_ruta'   => $facebookUser->getPictureUrl(),
                'id_facebook' => $facebookUser->getid()],

        ]));

    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {

        //return $this->router->generate('persona_new');
        dd($this->facebookClient->fetchUser());
        //return new RedirectResponse($this->router->generate('persona_new'));
        $facebookUser = $this->facebookClient->fetchUser();
        //dd($providerKey);
        // $pepe = new Persona();
        // $pepe->setNombre($facebookUser->getFirstName());
        // $pepe->setEmail($facebookUser->getEmail());
        // $pepe->setApellido($facebookUser->getLastName());
        // $pepe->setImageFilename($facebookUser->getPictureUrl());
        // $pepe->setIdFacebook($facebookUser->getid());
        dd($facebookUser);

        return null;

        //$this->EntityUserProvider->refreshUser($pepe);
        // return $this->router->generate('persona_new', ['Persona' => $pepe]);
        //return new RedirectResponse($this->router->generate('persona_new'));
        //dd('acaonAuthenticationSuccess', $pepe);

        //$this->userManager->updateUser($pepe);
        //$entityManager = $this->getDoctrine()->getManager();
        //fetchUser()
        //dd($this->facebookClient->fetchUser());
        // return $this->facebookClient->fetchUser();
        //return $userProvider->loadUserByUsername($pepe);
        //return $pepe;
        //return null;
        //dd('success!');
        //
        //dd('app.Username');
        //dd($this->getTargetPath($request->getSession(), $providerKey));

        // if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
        //     //dd($targetPath);
        //     return new RedirectResponse($targetPath);
        // }

        // return new RedirectResponse($this->router->generate('persona_index'));
        // //dd($this->router);
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {

        return new RedirectResponse($this->router->generate('persona_new'));
    }

    public function supportsRememberMe()
    {
        return true;
    }

    protected function getLoginUrl()
    {

        //return $this->router->generate('app_login');
        return $this->router->generate('persona_new');

    }
}
