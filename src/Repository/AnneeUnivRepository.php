<?php

namespace App\Repository;

use App\Entity\AnneeUniv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnneeUniv>
 *
 * @method AnneeUniv|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnneeUniv|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnneeUniv[]    findAll()
 * @method AnneeUniv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnneeUnivRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnneeUniv::class);
    }

    public function add(AnneeUniv $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AnneeUniv $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AnneeUniv[] Returns an array of AnneeUniv objects
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

//    public function findOneBySomeField($value): ?AnneeUniv
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
