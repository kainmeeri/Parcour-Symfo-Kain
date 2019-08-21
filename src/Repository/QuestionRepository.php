<?php

namespace App\Repository;

use App\Entity\Question;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Question|null find($id, $lockMode = null, $lockVersion = null)
 * @method Question|null findOneBy(array $criteria, array $orderBy = null)
 * @method Question[]    findAll()
 * @method Question[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Question::class);
    }

    /**
     * EXO 1 : Récupérer la liste les films par ordre alphabétique
     * Méthode en DQL (Doctrine Query Language)
     * 
     *  @return Question[] Returns an array of Movie objects
     */
    public function findAllByOrder()
    {
        return $this->getEntityManager()
            ->createQuery('
                SELECT m 
                FROM App\Entity\QUESTION m 
                ORDER BY m.createdAt DESC
            ')
            ->getResult();
    }
}
