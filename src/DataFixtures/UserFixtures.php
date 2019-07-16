<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 4; $i++) {
        $user = new User();
        $user->setEmail('user'.$i.'@user.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user,
            'password'
        ));
        $user->setRoles(array('ROLE_USER'));
        $manager->persist($user);
    }
    for ($j = 5; $j < 7; $j++) {
        $user = new User();
        $user->setEmail('admin'.$j.'@admin.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user,
            'password'
        ));
        $user->setRoles(array('ROLE_ADMIN'));
        $manager->persist($user);
    }

        $manager->flush();
    }
}
