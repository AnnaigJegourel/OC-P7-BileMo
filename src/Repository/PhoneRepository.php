<?php

namespace App\Repository;

use App\Entity\Phone;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Phone>
 *
 * @method Phone|null find($id, $lockMode = null, $lockVersion = null)
 * @method Phone|null findOneBy(array $criteria, array $orderBy = null)
 * @method Phone[]    findAll()
 * @method Phone[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PhoneRepository extends ServiceEntityRepository
{


    /**
     * Phone object constructor
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Phone::class);

    }


    /**
     * Save the Phone object to the database
     *
     * @param Phone $entity
     * @param boolean $flush
     *
     * @return void
     */
    public function save(Phone $entity, bool $flush=false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush === true) {
            $this->getEntityManager()->flush();
        }

    }


    /**
     * Delete the Phone object from the database
     *
     * @param Phone $entity
     * @param boolean $flush
     *
     * @return void
     */
    public function remove(Phone $entity, bool $flush=false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush === true) {
            $this->getEntityManager()->flush();
        }

    }


    /**
     * Fetch all Phone objects & paginate them
     *
     * @param integer $page
     * @param integer $limit
     *
     * @return mixed
     */
    public function findAllWithPagination(int $page, int $limit): mixed
    {
        $qb = $this->createQueryBuilder('p')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        return $qb->getQuery()->getResult();

    }


    /*
     * @return Phone[] Returns an array of Phone objects
     *
     *   public function findByExampleField($value): array
     *   {
     *       return $this->createQueryBuilder('p')
     *           ->andWhere('p.exampleField = :val')
     *           ->setParameter('val', $value)
     *           ->orderBy('p.id', 'ASC')
     *           ->setMaxResults(10)
     *           ->getQuery()
     *           ->getResult()
     *       ;
     *   }
     */


    /*
     * Fetch one object following a specified field
     *
     * public function findOneBySomeField($value): ?Phone
     * {
     *    return $this->createQueryBuilder('p')
     *        ->andWhere('p.exampleField = :val')
     *        ->setParameter('val', $value)
     *        ->getQuery()
     *        ->getOneOrNullResult()
     *    ;
     * }
     */


}
