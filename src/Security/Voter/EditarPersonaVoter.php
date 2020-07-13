<?php

namespace App\Security\Voter;

use App\Entity\Persona;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class EditarPersonaVoter extends Voter
{
    private $security;
    public function __construct(Security $security)
    {
        $this->security = $security;

    }
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['MANAGE'])
        && $subject instanceof \App\Entity\Persona;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        /** @var Persona $subject */
        $user = $token->getUser(); //->getId();
        //dd($subject);
        //dd($token);
        //dd($user);
        //dd();
        // $user = getPersona();
        // if the user is anonymous, do not grant access
        if (!$user instanceof \App\Entity\Persona) {
            // dd(!$user instanceof UserInterface);
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'MANAGE':
                // logic to determine if the user can EDIT
                // return true or false $persona->getId()
                if ($subject == $user) {
                    return true;
                    # code...
                }

                if ($this->security->isGranted('ROLE_SUPRA')) {
                    return true;
                    # code...
                }
                return false;
/*            case 'POST_VIEW':
// logic to determine if the user can VIEW
// return true or false
break;*/
        }

        return false;
    }
}
