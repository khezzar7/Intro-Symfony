<?php

namespace App\Repository;

use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Country|null find($id, $lockMode = null, $lockVersion = null)
 * @method Country|null findOneBy(array $criteria, array $orderBy = null)
 * @method Country[]    findAll()
 * @method Country[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CountryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Country::class);
    }

    // /**
    //  * @return Country[] Returns an array of Country objects
    //  */
    //approche queryBuilder
    public function findByPopNumber($num)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.population > :num')
            ->setParameter('num', $num)
            ->orderBy('c.name', 'ASC')
          //  ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    //approche DQL
    public function findAllCustom()
    {
      $em = $this->getEntityManager();
      $query = $em->createQuery(
        'SELECT c.name FROM App\Entity\Country c');

        return $query->execute();
    }

    public function findBySearch($search)
    {
      $em = $this->getEntityManager();
      $query = $em -> createQuery(
        'SELECT c FROM App\Entity\Country c WHERE c.name LIKE :search ORDER BY c.name ASC'
        )
        ->setParameter('search', '%'.$search.'%');

        return $query->execute();
    }


    //Approche SQL pur on renvoi un tableau de tableauX associatifs
    //correspondant à la structure de la table sql
    public function findAllRaw()
    {
      $connection = $this->getEntityManager()
      ->getConnection();
      $sql = 'SELECT * FROM country';
      $query = $connection->prepare($sql);
      $query->execute();
      return $query->fetchAll();

    }

}
