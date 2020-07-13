<?php

namespace App\Security;

use App\Repository\ApiTokenRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class ApiTokenAuthenticator extends AbstractGuardAuthenticator
{
    private $apiTokenRepo;
    public function __construct(ApiTokenRepository $apiTokenRepo)
    {
        $this->apiTokenRepo = $apiTokenRepo;
    }

    public function supports(Request $request)
    {
        // look for header "Authorization: Bearer <token>"
        return $request->headers->has('Authorization')
        && 0 === strpos($request->headers->get('Authorization'), 'Bearer ');
    }

    public function getCredentials(Request $request)
    {
        //dd($request);
        $authorizationHeader = $request->headers->get('Authorization');
        // skip beyond "Bearer "

        // skip beyond "Bearer "
        //dd(substr($authorizationHeader, 7));
        return substr($authorizationHeader, 7);
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        // todo

        // dd($credentials);

        $token = $this->apiTokenRepo->findOneBy([
            'token' => $credentials,
        ]);
        if (!$token) {
            //return;
            throw new CustomUserMessageAuthenticationException("TOKEN INVALIDA");

        }

        if ($token->isExpires()) {
            //return;
            throw new CustomUserMessageAuthenticationException("TOKEN Vencida el " . $token->getExpiresAt()->format('d-m-Y H:m'));

        }

        return $token->getUser();

    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        //dd('checking credentials');
        //$user = $this->getUser();
        //dd($user->getPassword() . " Nombre" . $user->getNombre());
        return true;

    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new JsonResponse(['message' => $exception->getMessageKey()], 401);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // todo
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        throw new Exception("Error Processing Request", 1);

    }

    public function supportsRememberMe()
    {
        return false;
    }
}
