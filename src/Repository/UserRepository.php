<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{


    /**
     * User object constructor
     *
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);

    }


    /**
     * Save the User object to the database
     *
     * @param User $entity
     * @param boolean $flush
     *
     * @return void
     */
    public function save(User $entity, bool $flush=false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush === true) {
            $this->getEntityManager()->flush();
        }

    }


    /**
     * Delete the User object from the database
     *
     * @param User $entity
     * @param boolean $flush
     *
     * @return void
     */
    public function remove(User $entity, bool $flush=false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush === true) {
            $this->getEntityManager()->flush();
        }

    }


    /**
     * Fetch a paginated users list of a customer, following id
     *
     * @param integer|null $idCustomer
     * @param integer $page
     * @param integer $limit
     *
     * @return mixed
     */
    public function findByCustomerPagin(int|null $idCustomer, int $page, int $limit): mixed
    {
        $qb = $this->createQueryBuilder('u')
            ->andWhere('u.customer = :customer_id')
            ->setParameter('customer_id', $idCustomer)
            ->orderBy('u.id', 'ASC')
            ->setFirstResult(($page - 1) * $limit)
            ->setMaxResults($limit);

        $query = $qb->getQuery();
        $query->setFetchMode(User::class, "customer", \Doctrine\ORM\Mapping\ClassMetadata::FETCH_EAGER);

        return $query->getResult();

    }


    /**
     * Used to upgrade (rehash) the user's password automatically over time
     *
     * @param PasswordAuthenticatedUserInterface $user
     * @param string $newHashedPassword
     *
     * @return void
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (($user instanceof User) === false) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->save($user, true);

    }


    /*
     * @return User[] Returns an array of User objects
     *
     *    public function findByExampleField($value): array
     *    {
     *        return $this->createQueryBuilder('u')
     *            ->andWhere('u.exampleField = :val')
     *            ->setParameter('val', $value)
     *            ->orderBy('u.id', 'ASC')
     *            ->setMaxResults(10)
     *            ->getQuery()
     *            ->getResult()
     *        ;
     *    }
     */


    /*
     *    public function findOneBySomeField($value): ?User
     *    {
     *        return $this->createQueryBuilder('u')
     *            ->andWhere('u.exampleField = :val')
     *            ->setParameter('val', $value)
     *            ->getQuery()
     *            ->getOneOrNullResult()
     *        ;
     *    }
     */


}
