<?php

namespace App\Repository;

use App\Entity\Attribute;
use App\Entity\AttributeValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AttributeValue>
 *
 * @method AttributeValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttributeValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttributeValue[]    findAll()
 * @method AttributeValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributeValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttributeValue::class);
    }
    public function findByAttribute(Attribute $attribute): array
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.Attribute = :attribute')
            ->setParameter('attribute', $attribute )
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return AttributeValue[] Returns an array of AttributeValue objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AttributeValue
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
