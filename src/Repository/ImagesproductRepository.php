<?php

namespace App\Repository;

use App\Entity\Imagesproduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Imagesproduct>
 *
 * @method Imagesproduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method Imagesproduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method Imagesproduct[]    findAll()
 * @method Imagesproduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImagesproductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Imagesproduct::class);
    }

//    /**
//     * @return Imagesproduct[] Returns an array of Imagesproduct objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Imagesproduct
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
