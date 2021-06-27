<?php

namespace App\Repository;

use App\Entity\Interfaces\UserInterface;
use App\Entity\User;
use App\Entity\Word;
use App\Repository\Interfaces\WordRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use function Doctrine\ORM\QueryBuilder;

/**
 * @method Word|null find($id, $lockMode = null, $lockVersion = null)
 * @method Word|null findOneBy(array $criteria, array $orderBy = null)
 * @method Word[]    findAll()
 * @method Word[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WordRepository extends ServiceEntityRepository implements WordRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Word::class);
    }

    public function findWordIfExist(string $word, UserInterface $user): ?Word
    {
        $qb = $this->createQueryBuilder('w');

        return $qb
            ->andWhere('w.user = :user')
            ->andWhere('UPPER(w.word) = :word')
            ->setParameter('user', $user)
            ->setParameter('word', strtoupper($word))
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function save(Word $word): void
    {
        $this->getEntityManager()->persist($word);
        $this->getEntityManager()->flush();
    }

    public function findByUser(User $user): iterable
    {
        $qb = $this->createQueryBuilder('w');

        return $qb
            ->andWhere('w.user = :user')
            ->setParameter('user', $user)
            ->addOrderBy('w.count', 'DESC')
            ->addOrderBy('w.word', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
