<?php

namespace App\DataFixtures;

use App\Entity\BookKT;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BooksFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $userRepository = $manager->getRepository(BookKT::class);
        $KTAll        = [
            [
                'region'   => 'Московская область',
                'index' => 1.7,
            ],
            [
                'region'   => 'Москва',
                'index' => 2,
            ],
            [
                'region'   => 'Ленинградская область',
                'index' => 1.3,
            ],
            [
                'region'   => 'Санкт-Петербург',
                'index' => 1.8,
            ],
            [
                'region'   => 'Воронеж',
                'index' => 1.5,
            ],
            [
                'region'   => 'Липецк',
                'index' => 1.5,
            ],
            [
                'region'   => 'Краснодар, Новороссийск',
                'index' => 1.8,
            ],
            [
                'region'   => 'Волгоград',
                'index' => 1.3,
            ],
            [
                'region'   => 'Ростов-на-Дону',
                'index' => 1.8,
            ],
            [
                'region'   => 'Самара',
                'index' => 1.6,
            ],
            [
                'region'   => 'Челябинск',
                'index' => 2.1,
            ],
            [
                'region'   => 'Екатеринбург',
                'index' => 1.8,
            ],
        ];

        // Запись объектов
        foreach ($KTAll as $KT) {
            // Создание
            $newKT = new BookKT();
            $newKT->setRegion($KT['region']);
            $newKT->setIndex($KT['index']);

            $manager->persist($newKT);
        }
        $manager->flush();
    }
}