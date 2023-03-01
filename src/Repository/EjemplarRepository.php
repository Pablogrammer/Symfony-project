<?php

namespace App\Repository;

use App\Entity\Ejemplar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LibroRepository;

/**
 * @extends ServiceEntityRepository<Ejemplar>
 *
 * @method Ejemplar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ejemplar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ejemplar[]    findAll()
 * @method Ejemplar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EjemplarRepository extends ServiceEntityRepository
{


    private LibroRepository $repository;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ejemplar::class);
        $this->repository=new LibroRepository($registry);
    }

    public function save(Ejemplar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);
        $this->repository->updatemas($entity->getLibro());

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Ejemplar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);
        $this->repository->update($entity->getLibro());

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Ejemplar[] Returns an array of Ejemplar objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ejemplar
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
