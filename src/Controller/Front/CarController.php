<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    #[Route('/car', name: 'car')]
    public function index(): Response
    {
        return $this->render('front/car/index.html.twig', [
            'controller_name' => 'CarController',
        ]);
    }
}
