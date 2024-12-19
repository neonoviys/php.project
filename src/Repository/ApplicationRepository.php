<?php

namespace App\Repository;

use App\Entity\Application;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Application>
 */
class ApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Application::class);
    }

    public function findAppropriate(Application $application): ?Application
    {
        return $this->createQueryBuilder('a')
            ->where('a.stock_id = :stock_id')
            ->andWhere('a.quantity = :quantity')
            ->andWhere('a.price = :price')
            ->andWhere('a.action = :action')
            ->andWhere('a.user_id = :user_id')
            ->setParameters(
                new ArrayCollection([
                    'stock_id' => $application->getStock()->getId(),
                    'quantity' => $application->getQuantity(),
                    'price' => $application->getPrice(),
                    'action' => $application->getAction()->getOpposite()->value,
                    'user_id' => $application->getUser()->getId(),
                    //'portfolios' => $application->getPortfolio()->getUser()->getPortfolios()
                ])
            )
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }






    public function saveApplication(Application $application): void
    {
        $this->getEntityManager()->persist($application);
        $this->getEntityManager()->flush();
    }


    public function removeApplication(Application $application): void
    {
        $this->getEntityManager()->remove($application);
        $this->getEntityManager()->flush();
    }

}
