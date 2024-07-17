<?php

namespace App\Repository;

use App\Entity\Complaint;
use App\Enum\ComplaintStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @extends ServiceEntityRepository<Complaint>
 */
class ComplaintRepository extends ServiceEntityRepository
{
    private AuthorizationCheckerInterface $checker;
    public function __construct(ManagerRegistry $registry, AuthorizationCheckerInterface $checker)
    {
        $this->checker = $checker;
        parent::__construct($registry, Complaint::class);
    }

    public function getAll(): QueryBuilder
    {
        $builder = $this->createQueryBuilder('q');

        if (!$this->checker->isGranted('ROLE_ADMIN')) {
            $builder->where('q.status = :status')
                ->setParameter('status', ComplaintStatus::ACCEPTED);
        }

        return $builder;
    }

//    /**
//     * @return Complaint[] Returns an array of Complaint objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Complaint
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
