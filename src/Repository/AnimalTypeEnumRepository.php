<?php

namespace App\Repository;

use App\Entity\AnimalTypeEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AnimalTypeEnum>
 *
 * @method AnimalTypeEnum|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnimalTypeEnum|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnimalTypeEnum[]    findAll()
 * @method AnimalTypeEnum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalTypeEnumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnimalTypeEnum::class);
    }

    public function save(AnimalTypeEnum $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AnimalTypeEnum $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AnimalTypeEnum[] Returns an array of AnimalTypeEnum objects
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

//    public function findOneBySomeField($value): ?AnimalTypeEnum
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
