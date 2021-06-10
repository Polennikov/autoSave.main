<?php

namespace App\DataFixtures;

use App\Entity\BookKT;
use App\Entity\BookTB;
use App\Entity\BookKBM;
use App\Entity\BookKBC;
use App\Entity\BookKP;
use App\Entity\BookKC;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class BooksFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
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
        $TBAll        = [
            [
                'category'   => 'A',
                'index' => '1000',
            ],
            [
                'category'   => 'M',
                'index' => '1000',
            ],
            [
                'category'   => 'B',
                'index' => '3500',
            ],
            [
                'category'   => 'BE',
                'index' => '4500',
            ],
            [
                'category'   => 'D',
                'index' => '3700',
            ],
            [
                'category'   => 'DE',
                'index' => '4800',
            ],
            [
                'category'   => 'C',
                'index' => '3700',
            ],
            [
                'category'   => 'CE',
                'index' => '4800',
            ],

        ];
        $KBMAll        = [
            [
                'class'   => 'M',
                'index' => '2.45',
                'payoutsNull'=>'0',
                'payoutOne'=>'M',
                'payoutTwo'=>'M',
                'payoutThree'=>'M',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '0',
                'index' => '2.3',
                'payoutsNull'=>'1',
                'payoutOne'=>'M',
                'payoutTwo'=>'M',
                'payoutThree'=>'M',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '1',
                'index' => '1.55',
                'payoutsNull'=>'2',
                'payoutOne'=>'M',
                'payoutTwo'=>'M',
                'payoutThree'=>'M',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '2',
                'index' => '1.4',
                'payoutsNull'=>'3',
                'payoutOne'=>'1',
                'payoutTwo'=>'M',
                'payoutThree'=>'M',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '3',
                'index' => '1',
                'payoutsNull'=>'4',
                'payoutOne'=>'1',
                'payoutTwo'=>'M',
                'payoutThree'=>'M',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '4',
                'index' => '0.95',
                'payoutsNull'=>'5',
                'payoutOne'=>'2',
                'payoutTwo'=>'1',
                'payoutThree'=>'M',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '5',
                'index' => '0.95',
                'payoutsNull'=>'5',
                'payoutOne'=>'2',
                'payoutTwo'=>'1',
                'payoutThree'=>'M',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '6',
                'index' => '0.85',
                'payoutsNull'=>'7',
                'payoutOne'=>'4',
                'payoutTwo'=>'2',
                'payoutThree'=>'M',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '7',
                'index' => '0.8',
                'payoutsNull'=>'8',
                'payoutOne'=>'4',
                'payoutTwo'=>'2',
                'payoutThree'=>'M',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '9',
                'index' => '0.7',
                'payoutsNull'=>'10',
                'payoutOne'=>'5',
                'payoutTwo'=>'2',
                'payoutThree'=>'1',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '10',
                'index' => '0.65',
                'payoutsNull'=>'11',
                'payoutOne'=>'6',
                'payoutTwo'=>'3',
                'payoutThree'=>'1',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '11',
                'index' => '0.6',
                'payoutsNull'=>'12',
                'payoutOne'=>'6',
                'payoutTwo'=>'3',
                'payoutThree'=>'1',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '12',
                'index' => '0.55',
                'payoutsNull'=>'13',
                'payoutOne'=>'6',
                'payoutTwo'=>'3',
                'payoutThree'=>'1',
                'payoutFour'=>'M',
            ],
            [
                'class'   => '13',
                'index' => '0.5',
                'payoutsNull'=>'13',
                'payoutOne'=>'7',
                'payoutTwo'=>'3',
                'payoutThree'=>'1',
                'payoutFour'=>'M',
            ],


        ];
        $KBCAll        = [
            [
                'age'   => '16',
                'yearOneMin' => '1.93',
                'yearOne'=>'1.9',
                'yearTwo'=>'1.87',
                'yearThree'=>'1.66',
                'yearFive'=>'1.64',
                'yearSeven'=>'1',
                'yearTen'=>'1',
                'yearFivten'=>'1',
            ],
            [
                'age'   => '22',
                'yearOneMin' => '1.79',
                'yearOne'=>'1.77',
                'yearTwo'=>'1.76',
                'yearThree'=>'1.06',
                'yearFive'=>'1.05',
                'yearSeven'=>'1.05',
                'yearTen'=>'1',
                'yearFivten'=>'1',
            ],
            [
                'age'   => '25',
                'yearOneMin' => '1.77',
                'yearOne'=>'1.68',
                'yearTwo'=>'1.61',
                'yearThree'=>'1.06',
                'yearFive'=>'1.05',
                'yearSeven'=>'1.05',
                'yearTen'=>'1.01',
                'yearFivten'=>'1',
            ],
            [
                'age'   => '30',
                'yearOneMin' => '1.62',
                'yearOne'=>'1.61',
                'yearTwo'=>'1.59',
                'yearThree'=>'1.04',
                'yearFive'=>'1.04',
                'yearSeven'=>'1.01',
                'yearTen'=>'1.96',
                'yearFivten'=>'1.95',
            ],
            [
                'age'   => '35',
                'yearOneMin' => '1.61',
                'yearOne'=>'1.59',
                'yearTwo'=>'1.58',
                'yearThree'=>'0.99',
                'yearFive'=>'0.96',
                'yearSeven'=>'0.95',
                'yearTen'=>'0.95',
                'yearFivten'=>'0.94',
            ],
            [
                'age'   => '40',
                'yearOneMin' => '1.59',
                'yearOne'=>'1.58',
                'yearTwo'=>'1.57',
                'yearThree'=>'0.95',
                'yearFive'=>'0.94',
                'yearSeven'=>'0.94',
                'yearTen'=>'0.94',
                'yearFivten'=>'0.94',
            ],
            [
                'age'   => '50',
                'yearOneMin' => '1.58',
                'yearOne'=>'1.57',
                'yearTwo'=>'1.56',
                'yearThree'=>'0.94',
                'yearFive'=>'0.94',
                'yearSeven'=>'0.94',
                'yearTen'=>'0.94',
                'yearFivten'=>'0.93',
            ],
            [
                'age'   => '60',
                'yearOneMin' => '1.55',
                'yearOne'=>'1.54',
                'yearTwo'=>'1.53',
                'yearThree'=>'0.92',
                'yearFive'=>'0.91',
                'yearSeven'=>'0.91',
                'yearTen'=>'0.91',
                'yearFivten'=>'0.9',
            ],



        ];
        $KPAll        = [
            [
                'period'   => '12',
                'index' => '1',
            ],
            [
                'period'   => '9',
                'index' => '0.95',
            ],
            [
                'period'   => '8',
                'index' => '0.9',
            ],
            [
                'period'   => '7',
                'index' => '0.8',
            ],
            [
                'period'   => '6',
                'index' => '0.7',
            ],
            [
                'period'   => '5',
                'index' => '0.65',
            ],
            [
                'period'   => '4',
                'index' => '0.6',
            ],
            [
                'period'   => '3',
                'index' => '0.5',
            ],
            [
                'period'   => '2',
                'index' => '0.4',
            ],

        ];
        $KCAll        = [
            [
                'period'   => '3',
                'index' => '0.5',
            ],
            [
                'period'   => '4',
                'index' => '0.6',
            ],
            [
                'period'   => '5',
                'index' => '0.65',
            ],
            [
                'period'   => '6',
                'index' => '0.7',
            ],
            [
                'period'   => '7',
                'index' => '0.8',
            ],
            [
                'period'   => '8',
                'index' => '0.9',
            ],
            [
                'period'   => '9',
                'index' => '0.95',
            ],
            [
                'period'   => '10',
                'index' => '1',
            ],

        ];
        // Запись объектов
        foreach ($KCAll as $KC) {
            // Создание
            $newKC = new BookKC();
            $newKC->setPeriod($KC['period']);
            $newKC->setIndex($KC['index']);

            $manager->persist($newKC);
        }
        // Запись объектов
        foreach ($KPAll as $KP) {
            // Создание
            $newKP = new BookKP();
            $newKP->setPeriod($KP['period']);
            $newKP->setIndex($KP['index']);

            $manager->persist($newKP);
        }
        // Запись объектов
        foreach ($KBCAll as $KBC) {
            // Создание
            $newKBC = new BookKBC();
            $newKBC->setAge($KBC['age']);
            $newKBC->setYearOneMin($KBC['yearOneMin']);
            $newKBC->setyearOne($KBC['yearOne']);
            $newKBC->setYearTwo($KBC['yearTwo']);
            $newKBC->setYearThree($KBC['yearThree']);
            $newKBC->setYearFive($KBC['yearFive']);
            $newKBC->setyearSeven($KBC['yearSeven']);
            $newKBC->setYearTen($KBC['yearTen']);
            $newKBC->setYearFivten($KBC['yearFivten']);


            $manager->persist($newKBC);
        }
        // Запись объектов
        foreach ($KBMAll as $KBM) {
            // Создание
            $newKBM = new BookKBM();
            $newKBM->setClass($KBM['class']);
            $newKBM->setIndex($KBM['index']);
            $newKBM->setPayoutsNull($KBM['payoutsNull']);
            $newKBM->setPayoutOne($KBM['payoutOne']);
            $newKBM->setPayoutTwo($KBM['payoutTwo']);
            $newKBM->setPayoutThree($KBM['payoutThree']);
            $newKBM->setPayoutFour($KBM['payoutFour']);

            $manager->persist($newKBM);
        }
        foreach ($KTAll as $KT) {
            // Создание
            $newKT = new BookKT();
            $newKT->setRegion($KT['region']);
            $newKT->setIndex($KT['index']);

            $manager->persist($newKT);
        }
        foreach ($TBAll as $TB) {
            // Создание
            $newTB = new BookTB();
            $newTB->setCategory($TB['category']);
            $newTB->setIndex($TB['index']);

            $manager->persist($newTB);
        }

        $manager->flush();
    }
}