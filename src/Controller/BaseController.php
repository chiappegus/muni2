<?php
namespace App\Controller;

use App\Entity\Persona;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    protected function getUser(): Persona
    {
        return parent::getUser();
    }
}
