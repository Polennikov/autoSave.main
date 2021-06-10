<?php

namespace App\DataFixtures;

use App\Entity\Auto;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AutoFixtures extends Fixture
{
    
    public function load(ObjectManager $manager)
    {
        $userRepository = $manager->getRepository(User::class);
        // Получаем пользователя
        $user = $userRepository->findOneBy(['email' => 'artem@mail.ru']);
        $user1 = $userRepository->findOneBy(['email' => 'vika@mail.ru']);
        $autoAll = [
            [
                'vin' => '11111',
                'marka' => 'opel',
                'model' => 'astra',
                'year' => 2007,
                'number' => 'о567от48',
                'number_sts' => '12343213',
                'color' => 'красный',
                'power' => 110,
                'mileage'=> 200000,
                'category' => 'B',
                'users_id' => $user,
            ],
            [
                'vin' => '11112',
                'marka' => 'honda',
                'model' => 'civic',
                'year' => 1996,
                'number' => 'о001от48',
                'number_sts' => '12343213',
                'color' => 'белый',
                'power' => 250,
                'mileage'=> 250000,
                'category' => 'B',
                'users_id' => $user,
            ],
            [
                'vin' => '11113',
                'marka' => 'mazda',
                'model' => '3 Mps',
                'year' => 2008,
                'number' => 'о111от48',
                'number_sts' => '12343213',
                'color' => 'черный',
                'power' => 260,
                'mileage'=> 100000,
                'category' => 'B',
                'users_id' => $user1,
            ],
            [
                'vin' => '11114',
                'marka' => 'toyota',
                'model' => 'supra',
                'year' => 1994,
                'number' => 'о007от48',
                'number_sts' => '12343213',
                'color' => 'серебро',
                'power' => 470,
                'mileage'=> 220000,
                'category' => 'B',
                'users_id' => $user1,
            ],
        ];

        // Запись объектов
        foreach ($autoAll as $auto) {
            // Создание курса
            $newAuto = new Auto();
            $newAuto->setVin($auto['vin']);
            $newAuto->setMarka($auto['marka']);
            $newAuto->setModel($auto['model']);
            $newAuto->setYear($auto['year']);
            $newAuto->setNumber($auto['number']);
            $newAuto->setNumberSts($auto['number_sts']);
            $newAuto->setColor($auto['color']);
            $newAuto->setPower($auto['power']);
            $newAuto->setCategory($auto['category']);
            $newAuto->setMileage($auto['mileage']);
            $newAuto->setUsers($auto['users_id']);

            $manager->persist($newAuto);
        }
        $manager->flush();
    }
}