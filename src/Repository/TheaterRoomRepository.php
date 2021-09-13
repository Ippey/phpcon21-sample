<?php

namespace App\Repository;

use App\Entity\TheaterRoom;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TheaterRoom|null find($id, $lockMode = null, $lockVersion = null)
 * @method TheaterRoom|null findOneBy(array $criteria, array $orderBy = null)
 * @method TheaterRoom[]    findAll()
 * @method TheaterRoom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TheaterRoomRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TheaterRoom::class);
    }

    // /**
    //  * @return TheaterRoom[] Returns an array of TheaterRoom objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TheaterRoom
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
