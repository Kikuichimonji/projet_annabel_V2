<?php

namespace App\Repository;

use App\Entity\Cabinet;
use App\Entity\Patient;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    public function getAll()
    {
        $entityManager= $this->getEntityManager();
        $query = $entityManager->createQuery(
            "SELECT p
             FROM App\Entity\Patient p
             ORDER BY p.id"
        );
        return $query->execute();
    }

    public function getByCabinet(Cabinet $cabinet)
    {
        $query = $this->createQueryBuilder("p")
                ->innerJoin("p.cabinet","c", "WITH","c.id= :id")
                ->setParameter("id",$cabinet);
        
        return $query->getQuery()->GetResult();
        /*$entityManager= $this->getEntityManager();
        $query = $entityManager->createQuery(
            "SELECT p
             FROM App\Entity\Patient p
             JOIN App\Entity\Cabinet c
             WHERE c.id = :id
             ORDER BY p.id"
        )->setParameter("id",1);
        return $query->execute();*/
    }

    // /**
    //  * @return Patient[] Returns an array of Patient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Patient
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
