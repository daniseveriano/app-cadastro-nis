<?php

namespace App\Repository;

use App\Entity\PeopleRegistered;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PeopleRegistered>
 *
 * @method PeopleRegistered|null find($id, $lockMode = null, $lockVersion = null)
 * @method PeopleRegistered|null findOneBy(array $criteria, array $orderBy = null)
 * @method PeopleRegistered[]    findAll()
 * @method PeopleRegistered[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeopleRegisteredRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PeopleRegistered::class);
    }

//    /**
//     * @return PeopleRegistered[] Returns an array of PeopleRegistered objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PeopleRegistered
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
