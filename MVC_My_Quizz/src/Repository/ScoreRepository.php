<?php

namespace App\Repository;

use App\Entity\Score;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Score|null find($id, $lockMode = null, $lockVersion = null)
 * @method Score|null findOneBy(array $criteria, array $orderBy = null)
 * @method Score[]    findAll()
 * @method Score[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Score::class);
    }

    public function findTotal(int $id): array
    {
        return $this->createQueryBuilder("s")
            ->select('c', 's')
            ->leftJoin("App\Entity\Categorie", "c",
                \Doctrine\ORM\Query\Expr\Join::WITH,
            "s.categorie = c.id")
            ->where("s.user = :user")
            ->setParameter("user", $id)
            ->getQuery()->execute();
    }

    public function findInfo(): array
    {
        return $this->createQueryBuilder("s")
            ->select('COUNT(s.categorie), SUM(s.score)/COUNT(s.score)', 'c')
            ->leftJoin("App\Entity\Categorie", "c",
                \Doctrine\ORM\Query\Expr\Join::WITH,
                "s.categorie = c.id")
            ->groupBy("s.categorie")
            ->getQuery()->execute();

    }

    // /**
    //  * @return Score[] Returns an array of Score objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Score
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
