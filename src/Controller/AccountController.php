<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_ADMIN")
 */
//class AccountController extends AbstractController
class AccountController extends BaseController
{
    /**
     * @Route("/account", name="app_account")
     */
    public function index(LoggerInterface $logger)
    {
        /*dd($this->getUser());

        ^ App\Entity\Persona {#6665 ▼
        -id: 3
        -nombre: "gust2"
        -apellido: "gust2"
        -dni: 26254
        -intendente: null
        -slug: "26254"
        -imageFilename: null
        -email: "gust2@gus.com"
        -roles: array:1 [▼
        0 => "ROLE_ADMIN"
        ]
        -password: "$argon2i$v=19$m=65536,t=4,p=1$Z2trcGVxdFdmL3J1R3J2Sw$TNY6zfj+t/a3bW+SkzpLUZobS1JHYTcHQoeE0veTJ+U"
        }*/

        $logger->debug('Checking account page for  Email' . $this->getUser()->getEmail());
        $logger->debug('Checking account page for Dni ' . $this->getUser()->getDni());

        return $this->render('account/index.html.twig', [
        ]);
    }

    /**
     * @Route("/api/account", name="api_account")
     * @IsGranted("ROLE_SUPRA")
     */
    public function accountApi()
    {
        $user = $this->getUser();
        // return $this->json($user);

        return $this->json($user, 200, [], [
            'groups' => ['main'],
        ]);
    }
}
