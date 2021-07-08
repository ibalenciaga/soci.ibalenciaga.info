<?php

namespace App\Repository;

use App\Entity\ReservaMesa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservaMesa|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservaMesa|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservaMesa[]    findAll()
 * @method ReservaMesa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservaMesaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservaMesa::class);
    }

    /*
    public function findOneBySomeField($value): ?ReservaMesa
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
