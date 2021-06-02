<?php

namespace App\Repository;

use App\Entity\Dtp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dtp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dtp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dtp[]    findAll()
 * @method Dtp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DtpRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dtp::class);
    }

    // /**
    //  * @return Dtp[] Returns an array of Dtp objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dtp
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
