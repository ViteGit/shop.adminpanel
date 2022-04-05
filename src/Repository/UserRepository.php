<?php

namespace App\Repository;

use App\Entity\User;
use App\VO\Email;
use App\VO\PhoneNumber;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements  UserLoaderInterface
{
    /**
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }


    /**
     * В качестве логина, или имени пользователя, в проекте используется номер телефона.
     * Данный метод ищет пользователя в базе данных в момент логина.
     *
     * @param string $phone
     *
     * @return UserInterface | null
     *
     * @throws NonUniqueResultException
     */
    public function loadUserByUsername($email)
    {
        try {
            $user = $this->createQueryBuilder('u')
                ->where('u.email = :email')
                ->setParameter('email', new Email($email))
                ->getQuery()
                ->getOneOrNullResult();
//        С помощью этого блока можно прочитать ошибку, если login-форма выдаёт следующее сообщение:
//        "Запрос аутентификации не может быть обработан в связи с проблемой в системе".
//        Security Bundle подробности не выводит
        } catch (\Exception $ex) {
//            $this->mailLogService->create("Ошибка аутентификации: {$ex->getMessage()}");
            dump($ex->getMessage());
            die;
        }

        return $user;
    }

    /**
     * @param PhoneNumber $phone
     *
     * @return User
     *
     * @throws EntityNotFoundException
     */
    public function getByPhone(PhoneNumber $phone): User
    {
        $user = $this->findOneBy([
            'phone' => $phone,
        ]);

        if (empty($user)) {
            throw new EntityNotFoundException("Пользователь с номером телефона = $phone не найден");
        }

        return $user;
    }

    /**
     * @param Email $email
     *
     * @return User
     *
     * @throws EntityNotFoundException
     */
    public function getByEmail(Email $email): User
    {
        $user = $this->findOneBy([
            'email' => $email,
        ]);

        if (empty($user)) {
            throw new EntityNotFoundException("Пользователь с email = $email не найден");
        }

        return $user;
    }

    /**
     * @param string $token
     * @return User
     *
     * @throws EntityNotFoundException
     */
    public function getByEmailToken(string $token): User
    {
        $user = $this->findOneBy([
            'emailVerificationToken' => $token,
        ]);

        if (empty($user)) {
            throw new EntityNotFoundException('Пользователь не найден');
        }

        return $user;
    }

    /**
     * @param string $token
     * @return User
     *
     * @throws EntityNotFoundException
     */
    public function getByPasswordResetToken(string $token): User
    {
        $user = $this->findOneBy([
            'passwordResetToken' => $token,
        ]);

        if (empty($user)) {
            throw new EntityNotFoundException('Пользователь не найден');
        }

        return $user;
    }

    /**
     * @param PhoneNumber $phone
     *
     * @return User | null
     */
    public function findByPhone(PhoneNumber $phone): ?User
    {
        return $this->findOneBy([
            'phone' => $phone,
        ]);
    }

    /**
     * @param PhoneNumber $phone
     *
     * @return bool
     */
    public function checkByPhone(PhoneNumber $phone): bool
    {
        return !empty($this->findOneBy(['phone' => $phone]));
    }

    /**
     * @param User $user
     *
     * @return void
     *
     * @throws ORMException
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(User $user): void
    {
        $this->_em->persist($user);
    }
}
