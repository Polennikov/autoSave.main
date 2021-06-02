<?php

namespace App\Repository;

use App\Entity\RelationDriver;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RelationDriver|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelationDriver|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelationDriver[]    findAll()
 * @method RelationDriver[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationDriverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelationDriver::class);
    }

    // /**
    //  * @return RelationDriver[] Returns an array of RelationDriver objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RelationDriver
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
