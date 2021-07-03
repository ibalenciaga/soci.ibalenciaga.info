<?php

namespace App\Repository;

use App\Entity\ConsumicionReserva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ConsumicionReserva|null find($id, $lockMode = null, $lockVersion = null)
 * @method ConsumicionReserva|null findOneBy(array $criteria, array $orderBy = null)
 * @method ConsumicionReserva[]    findAll()
 * @method ConsumicionReserva[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConsumicionReservaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ConsumicionReserva::class);
    }

    //
    //  * @return ConsumicionReserva[] Returns an array of ConsumicionReserva objects
    //
    public function findByReservaId($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.reserva = :val')
            ->setParameter('val', $value)
            ->orderBy('c.reserva', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return ConsumicionReserva[] Returns an array of ConsumicionReserva objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ConsumicionReserva
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
