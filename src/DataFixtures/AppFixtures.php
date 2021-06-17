<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
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
        // Создание пользователей с ролью ROLE_USER
        $user = new User();
        $user->setEmail('artem@mail.ru');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user, 'Artem48'));
        $user->setRoles(['ROLE_USER']);
        $user->setNumberDriver('12345');
        $user->setAdressDriver('null');
        $user->setName('Artem');
        $user->setSurname('Polennikov');
        $user->setMidName('Andreevich');
        $user->setExpDriver(3);
        $user->setDateDriver(new \DateTime('1999-06-06 00:00:00'));
        $user->setGenderDriver(1);
        $user->setKBM(0.65);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('vika@mail.ru');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user, 'Vika48'));
        $user->setRoles(['ROLE_USER']);
        $user->setNumberDriver('123456');
        $user->setAdressDriver('null');
        $user->setName('Vika');
        $user->setSurname('Polennikova');
        $user->setMidName('Vladimirovna');
        $user->setExpDriver(1);
        $user->setDateDriver(new \DateTime('1999-09-27 00:00:00'));
        $user->setGenderDriver(0);
        $user->setKBM(1);
        $manager->persist($user);

        // Создание администратора
        $user = new User();
        $user->setEmail('admin@mail.ru');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user, 'Admin48'));
        $user->setRoles(['ROLE_SUPER_ADMIN']);
        $user->setName('Admin');
        $user->setSurname('Admin');
        $user->setMidName('Admin');
        $user->setDateDriver(new \DateTime('2000-01-01 00:00:00'));
        $manager->persist($user);

        // Создание агента
        $user = new User();
        $user->setEmail('agent@mail.ru');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user, 'Agent48'));
        $user->setRoles(['ROLE_AGENT']);
        $user->setName('Artem');
        $user->setSurname('Polennikov');
        $user->setMidName('Andreevich');
        $user->setDateDriver(new \DateTime('1999-06-06 00:00:00'));

        $manager->persist($user);




        $manager->flush();
    }
}