<?php

namespace App\Repository;

use App\Entity\Carrier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Carrier>
 *
 * @method Carrier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Carrier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Carrier[]    findAll()
 * @method Carrier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarrierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carrier::class);
    }
    public function findByLikeName(string $searchcarrier): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name LIKE :searchcarrier')
            ->setParameter('searchcarrier', '%' . $searchcarrier . '%')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return CarrierPrice[] Returns an array of CarrierPrice objects
     */
    public function findByCarrier(int $carrierId): array
    {
        return $this->createQueryBuilder('cp')
            ->andWhere('cp.carrier = :carrierId')
            ->setParameter('carrierId', $carrierId)
            ->getQuery()
            ->getResult();
    }
//    /**
//     * @return Carrier[] Returns an array of Carrier objects
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

//    public function findOneBySomeField($value): ?Carrier
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
