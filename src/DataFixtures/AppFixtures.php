<?php

namespace App\DataFixtures;

use App\Entity\Cabinet;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
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
        $admin = new Utilisateur();
        $cabinet = new Cabinet();
        $cabinet->setLibelle("Logelbach");
        $admin->setUsername('OsteoAdmin');
        $admin->setPassword(
            $this->passwordEncoder->encodePassword(
                $admin,"osteoAdmin00!"
            )
        );
        $admin->setRoles(["ROLE_ADMIN"]);
        
        $manager->persist($cabinet);
        $manager->persist($admin);
        $manager->flush();
    }
}
