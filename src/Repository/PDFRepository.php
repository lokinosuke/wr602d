<?php

namespace App\Repository;

use App\Entity\PDF;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PDFRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PDF::class);
    }
    
    public function countPdfGeneratedByUserOnDate($userId, $startOfDay, $endOfDay)
    {
        return $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->where('p.user = :userId')
            ->andWhere('p.createdAt BETWEEN :startOfDay AND :endOfDay')
            ->setParameter('userId', $userId)
            ->setParameter('startOfDay', $startOfDay)
            ->setParameter('endOfDay', $endOfDay)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findTitlesByUser($userId): array
    {
        return $this->createQueryBuilder('p')
            ->select('p.title, p.createdAt, p.filepath')    
            ->where('p.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    }
}
