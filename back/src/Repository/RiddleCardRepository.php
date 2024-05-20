<?php

namespace App\Repository;

use App\Entity\RiddleCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RiddleCard>
 *
 * @method RiddleCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method RiddleCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method RiddleCard[]    findAll()
 * @method RiddleCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RiddleCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RiddleCard::class);
    }

    public function findAllIds(){
        return $this->createQueryBuilder('r')
            ->select('r.id')
            ->getQuery()
            ->getSingleColumnResult()
        ;
    }

    public function findRiddlesInIds(array $ids){
        return $this->createQueryBuilder('r')
            ->where("r.id IN(:ids)")
            ->setParameter("ids", $ids)
            ->getQuery()
            ->getArrayResult()
        ;
    }

//    /**
//     * @return RiddleCard[] Returns an array of RiddleCard objects
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

//    public function findOneBySomeField($value): ?RiddleCard
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
