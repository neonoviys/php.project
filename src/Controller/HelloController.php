<?php

namespace App\Controller;

use App\Service\HelloService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HelloController extends AbstractController
{
    public function __construct(private readonly HelloService $helloService)
    {
    
    }
   

   
    #[Route(path: '/hello', methods: ['GET'])]
    public function index(Request $request): Response
    {
        return new Response('Hello World!' . $request->getClientIp());
    }


    #[Route(path: '/hello/lucky/{number}', methods: ['GET'])]
    public function checkLuckyNumber(string $number) : Response
    {
        if($this->helloService->generateLuckyNumber() === $number){
            return new Response('Success');
        }else{
            return new Response('Fail');
        }
    }

   
   
   
    #[Route(path: '/prime/{number}', methods: ['GET'])]
    public function isPrime(int $number): Response
    {
        $isPrime = $this->helloService->checkPrime($number);
        $message = $isPrime ? "$number is a prime number." : "$number is not a prime number.";
        return new Response($message);
    }

}
