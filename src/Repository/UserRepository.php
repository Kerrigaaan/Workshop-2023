<?php

namespace App\Repository;

use App\DataTransformers\UserEntityToUserDTO;
use App\DTO\UserDTO;
use App\Entity\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
    public function createUser(UserDTO $user): bool
    {
        $salt = bin2hex(random_bytes(32));
        $entityUser = (new User())
            ->setEmail($user->email)
            ->setPassword(password_hash($user->password, PASSWORD_DEFAULT))
            ->setSalt($salt);
        $this->_em->persist($entityUser);
        $this->_em->flush();
        return true;
    }

    public function findUserById(int $id): ?UserDTO
    {
        $user = $this->findOneBy(['id' => $id]);
        return UserEntityToUserDTO::transformToDTO($user);
    }

    public function IsUserCredentialsValid(UserDTO $user): bool
    {
        $u = $this->findOneBy(['email' => $user->email]);
        if (is_null($u)) return false;
//        $hashedPassword = password_hash($user->password, PASSWORD_ARGON2ID, ['salt' => $u->getSalt()]);
//        return $hashedPassword === $u->getPassword();
        return password_verify($user->password, $u->getPassword());
    }
}
