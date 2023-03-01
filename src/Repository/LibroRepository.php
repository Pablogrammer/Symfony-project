<?php

namespace App\Repository;

use App\Entity\Ejemplar;
use App\Entity\Libro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Libro>
 *
 * @method Libro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Libro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Libro[]    findAll()
 * @method Libro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LibroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Libro::class);
    }

    public function save(Libro $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function update(Libro $entity,bool $flush = false):void
    {
        $entityManager = $this->getEntityManager();

        $cantidad=$entityManager->createQuery(
            'SELECT l.numEjemplares FROM App\Entity\Libro l WHERE l.id=?1'
        );
        $cantidad->setParameter(1,$entity->getId());
        $cantidadFinal=$cantidad->execute()[0]["numEjemplares"]-1;

        $query=$entityManager->createQuery(
            'UPDATE App\Entity\Libro l SET l.numEjemplares=?1 WHERE l.id=?2');

        $query->setParameter(1,$cantidadFinal);
        $query->setParameter(2,$entity->getId());
        $query->execute();

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function updatemas(Libro $entity,bool $flush = false):void
    {
        $entityManager = $this->getEntityManager();

        $cantidad=$entityManager->createQuery(
            'SELECT l.numEjemplares FROM App\Entity\Libro l WHERE l.id=?1'
        );
        $cantidad->setParameter(1,$entity->getId());
        $cantidadFinal=$cantidad->execute()[0]["numEjemplares"]+1;

        $query=$entityManager->createQuery(
            'UPDATE App\Entity\Libro l SET l.numEjemplares=?1 WHERE l.id=?2');

        $query->setParameter(1,$cantidadFinal);
        $query->setParameter(2,$entity->getId());
        $query->execute();

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Libro|Ejemplar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Libro[] Returns an array of Libro objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Libro
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
