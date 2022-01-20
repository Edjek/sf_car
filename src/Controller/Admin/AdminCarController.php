<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCarController extends AbstractController
{
    #[Route('/admin/car', name: 'admin_car_list')]
    public function carList(CarRepository $carRepository)
    {
        $cars = $carRepository->findAll();

        return $this->render('admin/admin_car/cars.html.twig', [
            'cars' => $cars,
        ]);
    }

    #[Route('/admin/create/car', name: 'admin_create_car')]
    public function createCar(EntityManagerInterface $entityManagerInterface, Request $request)
    {
        $car = new Car();

        $carForm = $this->createForm(CarType::class, $car);

        $carForm->handleRequest($request);

        if ($carForm->isSubmitted() && $carForm->isValid()) {
            $entityManagerInterface->persist($car);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'Une marque a été créé'
            );

            return $this->redirectToRoute("admin_car_list");
        }

        return $this->render("admin/admin_car/carform.html.twig", ['carForm' => $carForm->createView()]);
    }

    #[Route('/admin/update/car/{id}', name: 'admin_update_car')]
    public function updateCar(
        $id,
        CarRepository $carRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface
    ) {

        $car = $carRepository->find($id);

        $carForm = $this->createForm(CarType::class, $car);

        $carForm->handleRequest($request);

        if ($carForm->isSubmitted() && $carForm->isValid()) {
            $entityManagerInterface->persist($car);
            $entityManagerInterface->flush();

            $this->addFlash(
                'notice',
                'La marque a été modifié'
            );

            return $this->redirectToRoute('admin_car_list');
        }

        return $this->render("admin/admin_car/carform.html.twig", ['carForm' => $carForm->createView()]);
    }

    #[Route('/admin/delete/car/{id}', name: 'admin_delete_car')]
    public function deleteCar($id, CarRepository $carRepository, EntityManagerInterface $entityManagerInterface)
    {
        $car = $carRepository->find($id);

        $entityManagerInterface->remove($car);

        $entityManagerInterface->flush();

        $this->addFlash(
            'notice',
            'La marque a été supprimé'
        );

        return $this->redirectToRoute("admin_car_list");
    }
}
