<?php

namespace App\Repository;

use App\Entity\TaxRules;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TaxRules>
 *
 * @method TaxRules|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaxRules|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaxRules[]    findAll()
 * @method TaxRules[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaxRulesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaxRules::class);
    }

//    /**
//     * @return TaxRules[] Returns an array of TaxRules objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TaxRules
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
