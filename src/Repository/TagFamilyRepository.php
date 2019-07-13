<?php

namespace App\Repository;

use App\Entity\TagFamily;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TagFamily|null find($id, $lockMode = null, $lockVersion = null)
 * @method TagFamily|null findOneBy(array $criteria, array $orderBy = null)
 * @method TagFamily[]    findAll()
 * @method TagFamily[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagFamilyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TagFamily::class);
    }

    // /**
    //  * @return TagFamily[] Returns an array of TagFamily objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TagFamily
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
