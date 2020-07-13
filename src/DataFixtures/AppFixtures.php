<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\Persona;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {

        $i    = 0;
        $user = new Persona();
        $user->setEmail(sprintf('gust%d@gus.com', $i));
        $user->setNombre(sprintf('gust%d', $i));
        $user->setApellido(sprintf('gust%d', $i));
        $user->setDni(26252 + $i);
        $user->setRoles(['ROLE_SUPRA']);

        //$user->setNombre($this->faker->firstName);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'gus'
        ));
        $apiToken1 = new ApiToken($user);
        $apiToken2 = new ApiToken($user);
        $manager->persist($apiToken1);
        $manager->persist($apiToken2);
        $manager->persist($user);

        // $product = new Product();
        // $manager->persist($product);
        for ($i = 1; $i < 10; $i++) {

            $user = new Persona();
            $user->setEmail(sprintf('gust%d@gus.com', $i));
            $user->setNombre(sprintf('gust%d', $i));
            $user->setApellido(sprintf('gust%d', $i));
            $user->setDni(26252 + $i);
            $user->setRoles(['ROLE_ADMIN']);

            //$user->setNombre($this->faker->firstName);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'gus'
            ));
            $apiToken1 = new ApiToken($user);
            $apiToken2 = new ApiToken($user);
            $manager->persist($apiToken1);
            $manager->persist($apiToken2);
            $manager->persist($user);

        };

        for ($i = 10; $i < 20; $i++) {

            $user = new Persona();
            $user->setEmail(sprintf('gust%d@gus.com', $i));
            $user->setNombre(sprintf('gust%d', $i));
            $user->setApellido(sprintf('gust%d', $i));
            $user->setDni(26252 + $i);
            //$user->setRoles(['ROLE_ADMIN']);

            //$user->setNombre($this->faker->firstName);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'gus'
            ));
            $apiToken1 = new ApiToken($user);
            $apiToken2 = new ApiToken($user);
            $manager->persist($apiToken1);
            $manager->persist($apiToken2);
            $manager->persist($user);

        };
        /* for ($i = 0; $i < 20; $i++) {

        $user->setEmail(sprintf('gus%d@gus.com', $i));
        $user->setNombre(sprintf('gus%d', $i));
        $user->setApellido(sprintf('gus%d', $i));
        $user->setDni(26258210 + $i);
        $user->setRoles(["ROLE_ADMIN"]);
        //$user->setNombre($this->faker->firstName);
        $user->setPassword($this->passwordEncoder->encodePassword(
        $user,
        'gus'
        ));
        $manager->persist($user);
        };

        $manager->flush();*/
        $manager->flush();

    }
}
