<?php

namespace App\Repository;

use App\Entity\FacturaReserva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FacturaReserva|null find($id, $lockMode = null, $lockVersion = null)
 * @method FacturaReserva|null findOneBy(array $criteria, array $orderBy = null)
 * @method FacturaReserva[]    findAll()
 * @method FacturaReserva[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FacturaReservaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FacturaReserva::class);
    }

    //
    //  @return FacturaReserva[] Returns an array of FacturaReserva objects
    //
    public function findByReservaId($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.reserva = :val')
            ->setParameter('val', $value)
            ->orderBy('f.reserva', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return FacturaReserva[] Returns an array of FacturaReserva objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FacturaReserva
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
