<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCarController extends AbstractController
{
    #[Route('/admin/car', name: 'admin_car')]
    public function index(): Response
    {
        return $this->render('admin/admin_car/index.html.twig', [
            'controller_name' => 'AdminCarController',
        ]);
    }
}
