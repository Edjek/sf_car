<?php

namespace App\Controller\Front;

use App\Repository\GroupRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GroupController extends AbstractController
{
    #[Route('/groups', name: 'group_list')]
    public function groupList(GroupRepository $groupRepository): Response
    {
        $groups = $groupRepository->findAll();

        return $this->render('front/group/groups.html.twig', [
            'groups' => $groups,
        ]);
    }

    #[Route('/group/{id}', name: 'group_show')]
    public function groupShow($id, GroupRepository $groupRepository): Response
    {
        $group = $groupRepository->find($id);

        return $this->render('front/group/group.html.twig', [
            'group' => $group,
        ]);
    }
}
