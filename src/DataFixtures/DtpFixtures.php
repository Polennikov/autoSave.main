<?php

namespace App\DataFixtures;

use App\Entity\Auto;
use App\Entity\User;
use App\Entity\Dtp;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DtpFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $userRepository = $manager->getRepository(User::class);
        $autoRepository = $manager->getRepository(Auto::class);
        // Получаем пользователя
        $user = $userRepository->findOneBy(['email' => 'artem@mail.ru']);
        $user1 = $userRepository->findOneBy(['email' => 'vika@mail.ru']);
        $auto = $autoRepository->findOneBy(['vin' => '11111']);
        $auto1 = $autoRepository->findOneBy(['vin' => '11112']);
        $auto2 = $autoRepository->findOneBy(['vin' => '11113']);
        $auto3 = $autoRepository->findOneBy(['vin' => '11114']);
        $dtpAll = [
            [
                'date_dtp' => '1999-06-06 00:00:00',
                'description' => 'Произощло ДТП',
                'adress_dtp' => 'Москва',
                'degree' => 'легкое',
                'initiator' => 1,
                'autos' => $auto,
                'users' => $user,
            ],
            [
                'date_dtp' => '1999-06-06 00:00:00',
                'description' => 'Произощло ДТП',
                'adress_dtp' => 'Москва',
                'degree' => 'легкое',
                'initiator' => 1,
                'autos' => $auto,
                'users' => $user1,
            ],
            [
                'date_dtp' => '1999-06-06 00:00:00',
                'description' => 'Произощло ДТП',
                'adress_dtp' => 'Москва',
                'degree' => 'легкое',
                'initiator' => 0,
                'autos' => $auto1,
                'users' => $user,
            ],
            [
                'date_dtp' => '1999-06-06 00:00:00',
                'description' => 'Произощло ДТП',
                'adress_dtp' => 'Москва',
                'degree' => 'легкое',
                'initiator' => 1,
                'autos' => $auto1,
                'users' => $user1,
            ],
            [
                'date_dtp' => '1999-06-06 00:00:00',
                'description' => 'Произощло ДТП',
                'adress_dtp' => 'Москва',
                'degree' => 'легкое',
                'initiator' => 0,
                'autos' => $auto2,
                'users' => $user,
            ],
            [
                'date_dtp' => '1999-06-06 00:00:00',
                'description' => 'Произощло ДТП',
                'adress_dtp' => 'Москва',
                'degree' => 'легкое',
                'initiator' => 0,
                'autos' => $auto3,
                'users' => $user1,
            ],
            [
                'date_dtp' => '1999-06-06 00:00:00',
                'description' => 'Произощло ДТП',
                'adress_dtp' => 'Москва',
                'degree' => 'легкое',
                'initiator' => 0,
                'autos' => $auto3,
                'users' => $user,
            ],


        ];

        // Запись объектов
        foreach ($dtpAll as $dtp) {
            // Создание курса
            $newDtp = new Dtp();
            $newDtp->setDateDtp(new \DateTime($dtp['date_dtp']));
            $newDtp->setDescription($dtp['description']);
            $newDtp->setAdressDtp($dtp['adress_dtp']);
            $newDtp->setDegree($dtp['degree']);
            $newDtp->setInitiator($dtp['initiator']);
            $newDtp->setAutos($dtp['autos']);
            $newDtp->setUsers($dtp['users']);


            $manager->persist($newDtp);
        }
        $manager->flush();
    }
}