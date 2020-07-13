<?php

namespace App\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

//use Nelmio\Alice\Loader\NativeLoader;

class LoadFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //$loader = new NativeLoader();

        /*====================================
        =            aca lo borro            =
        ====================================*/
        $loader    = new AppNativeLoader();
        $objectSet = $loader->loadFile(__DIR__ . '/fixtures.yml')->getObjects();
        foreach ($objectSet as $object) {
            $manager->persist($object);
        }

        /*=====  End of aca lo borro  ======*/

        $manager->flush();
    }
}
