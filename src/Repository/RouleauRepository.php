<?php

namespace App\Repository;

use App\Entity\Rouleau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Rouleau>
 *
 * @method Rouleau|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rouleau|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rouleau[]    findAll()
 * @method Rouleau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RouleauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rouleau::class);
    }

//    /**
//     * @return Rouleau[] Returns an array of Rouleau objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Rouleau
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
