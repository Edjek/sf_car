<?php

namespace App\Controller\Admin;

use App\Entity\Group;
use App\Form\GroupType;
use App\Repository\GroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminGroupController extends AbstractController
{
    #[Route('/admin/group', name: 'admin_group_list')]
    public function groupList(GroupRepository $groupRepository)
    {
        $groups = $groupRepository->findAll();

        return $this->render('admin/admin_group/groups.html.twig', [
            'groups' => $groups,
        ]);
    }

    #[Route('/admin/create/group', name: 'admin_create_group')]
    public function createGroup(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $group = new Group();

        $groupForm = $this->createForm(GroupType::class, $group);

        $groupForm->handleRequest($request);

        if ($groupForm->isSubmitted() && $groupForm->isValid()) {
            $entityManagerInterface->persist($group);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Une groupe a été créé'
            );

            return $this->redirectToRoute("admin_group_list");
        }

        return $this->render("admin/admin_group/groupform.html.twig", ['groupForm' => $groupForm->createView()]);
    }

    #[Route('/admin/update/group/{id}', name: 'admin_update_group')]
    public function updateGroup(
        $id,
        GroupRepository $groupRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface
    ) {

        $group = $groupRepository->find($id);

        $groupForm = $this->createForm(GroupType::class, $group);

        $groupForm->handleRequest($request);

        if ($groupForm->isSubmitted() && $groupForm->isValid()) {
            $entityManagerInterface->persist($group);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'La groupe a été modifié'
            );

            return $this->redirectToRoute('admin_group_list');
        }

        return $this->render("admin/admin_group/groupform.html.twig", ['groupForm' => $groupForm->createView()]);
    }

    #[Route('/admin/delete/group/{id}', name: 'admin_delete_group')]
    public function deleteGroup($id, GroupRepository $groupRepository, EntityManagerInterface $entityManagerInterface)
    {
        $group = $groupRepository->find($id);

        $entityManagerInterface->remove($group);

        $entityManagerInterface->flush();

        $this->addFlash(
            'notice',
            'La groupe a été supprimé'
        );

        return $this->redirectToRoute("admin_group_list");
    }
}
