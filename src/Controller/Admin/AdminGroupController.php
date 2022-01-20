<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminGroupController extends AbstractController
{
    #[Route('/admin/group', name: 'admin_group')]
    public function index(): Response
    {
        return $this->render('admin/admin_group/index.html.twig', [
            'controller_name' => 'AdminGroupController',
        ]);
    }
}
