<?php

namespace App\Service;

use App\Entity\Application;
use App\Repository\ApplicationRepository;

class DealService
{
    public function __construct(
        private readonly ApplicationRepository $applicationRepository,
    )
    {
    }

    public function findAppropriate(Application $application): ?Application
    {
        return $this->applicationRepository->findAppropriate($application);
    
    }

    public function execute(Application $buyApplication, Application $sellApplication): void
    {   
        $buyPortfolio = $buyApplication->getUser()->getPortfolios()->current();
        $sellPortfolio = $sellApplication->getUser()->getPortfolios()->current();

        $buyPortfolio
            ->subBalance($sellApplication->getTotal())
            ->subBalance($buyApplication->getTotal())
            ;
    }








}