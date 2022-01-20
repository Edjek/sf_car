<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBrandController extends AbstractController
{
    #[Route('/admin/brand', name: 'admin_brand')]
    public function index(): Response
    {
        return $this->render('admin/admin_brand/index.html.twig', [
            'controller_name' => 'AdminBrandController',
        ]);
    }
}
