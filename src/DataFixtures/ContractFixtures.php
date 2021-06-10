<?php

namespace App\DataFixtures;

use App\Entity\Auto;
use App\Entity\User;
use App\Entity\Contract;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContractFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $userRepository = $manager->getRepository(User::class);
        // Получаем пользователя
        $user = $userRepository->findOneBy(['email' => 'agent@mail.ru']);

        $autoRepository = $manager->getRepository(Auto::class);
        // Получаем пользователя
        $auto1       = $autoRepository->findOneBy(['vin' => '11111']);
        $auto2       = $autoRepository->findOneBy(['vin' => '11112']);
        $auto3       = $autoRepository->findOneBy(['vin' => '11113']);
        $contractAll = [
            //  На рассмотрении
            [
                'date_start'      => '2021-04-13 00:00:00',
                'date_end'        => '2022-04-13 00:00:00',
                'date_start_one'  => '2021-04-13 00:00:00',
                'date_end_one'    => '2021-10-10 00:00:00',
                'date_start_two'  => '2022-01-13 00:00:00',
                'date_end_two'    => '2022-04-13 00:00:00',
                'date_start_tree' => null,
                'date_end_tree'   => null,
                'amount'          => '7800',
                'diagnostic_card' => 'g7ny98yn9ve85',
                'purpose'         => 'личное использование',
                'non_limited'     => 1,
                'trailer'     => 1,
                'status'          => 1,
                'agent_id'        => $user->getId(),
                'auto'            => $auto1,
            ],
            [
                'date_start'      => '2021-03-06 00:00:00',
                'date_end'        => '2022-03-06 00:00:00',
                'date_start_one'  => '2021-03-06 00:00:00',
                'date_end_one'    => '2021-12-01 00:00:00',
                'date_start_two'  => '2022-01-01 00:00:00',
                'date_end_two'    => '2022-03-06 00:00:00',
                'date_start_tree' => null,
                'date_end_tree'   => null,
                'amount'          => '13450',
                'diagnostic_card' => 'g7ny98yn9ve85',
                'purpose'         => 'личное использование',
                'non_limited'     => 1,
                'trailer'     => 0,
                'status'          => 1,
                'agent_id'        => $user->getId(),
                'auto'            => $auto2,
            ],
            // Ожидают оплату
            [
                'date_start'      => '2021-05-28 00:00:00',
                'date_end'        => '2022-05-28 00:00:00',
                'date_start_one'  => '2021-05-28 00:00:00',
                'date_end_one'    => '2022-05-28 00:00:00',
                'date_start_two'  => null,
                'date_end_two'    => null,
                'date_start_tree' => null,
                'date_end_tree'   => null,
                'amount'          => '15800',
                'diagnostic_card' => 'g7ny98yn9ve85',
                'purpose'         => 'личное использование',
                'non_limited'     => 0,
                'trailer'     => 0,
                'status'          => 2,
                'agent_id'        => $user->getId(),
                'auto'            => $auto3,
            ],
            // Действующие
            [
                'date_start'      => '2021-05-28 00:00:00',
                'date_end'        => '2021-05-28 00:00:00',
                'date_start_one'  => '2021-05-28 00:00:00',
                'date_end_one'    => '2021-07-28 00:00:00',
                'date_start_two'  => '2021-01-28 00:00:00',
                'date_end_two'    => '2022-05-28 00:00:00',
                'date_start_tree' => null,
                'date_end_tree'   => null,
                'amount'          => '17850',
                'diagnostic_card' => 'g7ny98yn9ve85',
                'purpose'         => 'Коммерческое использование',
                'non_limited'     => 1,
                'trailer'     => 1,
                'status'          => 3,
                'agent_id'        => $user->getId(),
                'auto'            => $auto3,
            ],
            // истекшие
            [
                'date_start'      => '2019-05-28 00:00:00',
                'date_end'        => '2020-05-28 00:00:00',
                'date_start_one'  => '2019-05-28 00:00:00',
                'date_end_one'    => '2020-05-28 00:00:00',
                'date_start_two'  => null,
                'date_end_two'    => null,
                'date_start_tree' => null,
                'date_end_tree'   => null,
                'amount'          => '16500',
                'diagnostic_card' => 'g7ny98yn9ve85',
                'purpose'         => 'личное использование',
                'non_limited'     => 0,
                'trailer'     => 0,
                'status'          => 4,
                'agent_id'        => $user->getId(),
                'auto'            => $auto3,
            ],
            [
                'date_start'      => '2019-05-28 00:00:00',
                'date_end'        => '2020-05-28 00:00:00',
                'date_start_one'  => '2019-05-28 00:00:00',
                'date_end_one'    => '2019-07-28 00:00:00',
                'date_start_two'  => '2020-01-28 00:00:00',
                'date_end_two'    => '2020-05-28 00:00:00',
                'date_start_tree' => null,
                'date_end_tree'   => null,
                'amount'          => '14600',
                'diagnostic_card' => 'g7ny98yn9ve85',
                'purpose'         => 'Коммерческое использование',
                'non_limited'     => 1,
                'trailer'     => 1,
                'status'          => 4,
                'agent_id'        => $user->getId(),
                'auto'            => $auto3,
            ],

        ];

        // Запись объектов
        foreach ($contractAll as $contract) {
            // Создание курса
            $newContract = new Contract();
            $newContract->setDateStart(new \DateTime($contract['date_start']));
            $newContract->setDateEnd(new \DateTime($contract['date_end']));
            $newContract->setDateStartOne(new \DateTime($contract['date_start_one']));
            $newContract->setDateEndOne(new \DateTime($contract['date_end_one']));

            if ($contract['date_start_two']) {
                $newContract->setDateStartTwo(new \DateTime($contract['date_start_two']));
                $newContract->setDateEndTwo(new \DateTime($contract['date_end_two']));
            }
            if ($contract['date_start_tree']) {
                $newContract->setDateStartTree(new \DateTime($contract['date_start_tree']));
                $newContract->setDateEndTree(new \DateTime($contract['date_end_tree']));
            }


            $newContract->setAmount($contract['amount']);
            $newContract->setDiagnosticCard($contract['diagnostic_card']);
            $newContract->setPurpose($contract['purpose']);
            $newContract->setStatus($contract['status']);
            $newContract->setNonLimited($contract['non_limited']);
            $newContract->setTrailer($contract['trailer']);
            $newContract->setAgentId($contract['agent_id']);
            $newContract->setAuto($contract['auto']);

            $manager->persist($newContract);
        }
        $manager->flush();
    }
}