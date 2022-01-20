<?php

namespace App\Controller\Front;

use App\Repository\CarRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CarController extends AbstractController
{
    #[Route('/cars', name: 'car_list')]
    public function carList(CarRepository $carRepository): Response
    {
        $cars = $carRepository->findAll();

        return $this->render('front/car/cars.html.twig', [
            'cars' => $cars,
        ]);
    }

    #[Route('/car/{id}', name: 'car_show')]
    public function carShow($id, CarRepository $carRepository): Response
    {
        $car = $carRepository->find($id);

        return $this->render('front/car/car.html.twig', [
            'car' => $car,
        ]);
    }

    #[Route('/search', name: 'search')]
    public function search(CarRepository $carRepository, Request $request)
    {
        $search = $request->query->get('search');

        $cars = $carRepository->searchByTerm($search);

        return $this->render('front/car/cars.html.twig', [
            'cars' => $cars,
        ]);
    }
}
