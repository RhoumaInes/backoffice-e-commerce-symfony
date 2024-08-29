<?php

namespace App\Repository;

use App\Entity\CarrierPrice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CarrierPrice>
 *
 * @method CarrierPrice|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarrierPrice|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarrierPrice[]    findAll()
 * @method CarrierPrice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarrierPriceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarrierPrice::class);
    }

//    /**
//     * @return CarrierPrice[] Returns an array of CarrierPrice objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CarrierPrice
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
