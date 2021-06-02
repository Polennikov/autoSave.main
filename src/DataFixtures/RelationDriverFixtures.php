<?php

namespace App\DataFixtures;

use App\Entity\Auto;
use App\Entity\User;
use App\Entity\Contract;
use App\Entity\RelationDriver;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RelationDriverFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $userRepository = $manager->getRepository(User::class);
        // Получаем пользователя
        $user = $userRepository->findOneBy(['email' => 'artem@mail.ru']);
        $user1 = $userRepository->findOneBy(['email' => 'vika@mail.ru']);

        $contractRepository = $manager->getRepository(Contract::class);
        // Получаем пользователя
        $contract = $contractRepository->findOneBy(['amount' => '7800']);
        $contract1 = $contractRepository->findOneBy(['amount' => '13450']);
        $contract2 = $contractRepository->findOneBy(['amount' => '15800']);
        $contract3 = $contractRepository->findOneBy(['amount' => '17850']);
        $contract4 = $contractRepository->findOneBy(['amount' => '16500']);
        $contractAll = [
            [
                'users' => $user,
                'contracts' => $contract,
                
            ],
            [
                'users' => $user1,
                'contracts' => $contract,

            ],
            [
                'users' => $user,
                'contracts' => $contract1,

            ],
            [
                'users' => $user1,
                'contracts' => $contract2,

            ],
        ];

        // Запись объектов
        foreach ($contractAll as $contract) {
            // Создание курса
            $newRelationDriver = new RelationDriver();
            $newRelationDriver->setUsers($contract['users']);
            $newRelationDriver->setContracts($contract['contracts']);
            $manager->persist($newRelationDriver);
        }
        $manager->flush();
    }
}