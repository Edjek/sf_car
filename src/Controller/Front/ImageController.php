<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/image', name: 'image')]
    public function index(): Response
    {
        return $this->render('front/image/index.html.twig', [
            'controller_name' => 'ImageController',
        ]);
    }
}
