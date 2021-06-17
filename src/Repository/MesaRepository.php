<?php

namespace App\Repository;

use App\Entity\Mesa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mesa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mesa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mesa[]    findAll()
 * @method Mesa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MesaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mesa::class);
    }

    public function findMesasLibres($fecha,$turno){
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            "SELECT mesa.id, mesa.numero
            FROM App\Entity\Mesa mesa
            WHERE mesa.id NOT IN (
                SELECT mesa.id
                FROM App\Entity\Reserva reserva, App\Entity\ReservaMesa reserva_mesa, App\Entity\Turno turno
                WHERE reserva.id = reserva_mesa.reserva AND reserva_mesa.mesa = mesa.id AND reserva.turno = turno.id
           AND reserva.fecha = '".$fecha."' AND turno = ".$turno.")"

        );

        // returns an array of Product objects
        return $query->getResult();
    }




    // /**
    //  * @return Mesa[] Returns an array of Mesa objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mesa
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
