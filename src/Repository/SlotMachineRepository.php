<?php

namespace App\Repository;

use App\Entity\SlotMachine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SlotMachine>
 *
 * @method SlotMachine|null find($id, $lockMode = null, $lockVersion = null)
 * @method SlotMachine|null findOneBy(array $criteria, array $orderBy = null)
 * @method SlotMachine[]    findAll()
 * @method SlotMachine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SlotMachineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SlotMachine::class);
    }

//    /**
//     * @return SlotMachine[] Returns an array of SlotMachine objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SlotMachine
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
