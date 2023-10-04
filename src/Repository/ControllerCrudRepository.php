<?php

namespace App\Repository;

use App\Entity\ControllerCrud;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ControllerCrud>
 *
 * @method ControllerCrud|null find($id, $lockMode = null, $lockVersion = null)
 * @method ControllerCrud|null findOneBy(array $criteria, array $orderBy = null)
 * @method ControllerCrud[]    findAll()
 * @method ControllerCrud[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ControllerCrudRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ControllerCrud::class);
    }

//    /**
//     * @return ControllerCrud[] Returns an array of ControllerCrud objects
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

//    public function findOneBySomeField($value): ?ControllerCrud
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
