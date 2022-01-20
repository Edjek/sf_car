<?php

namespace App\Controller\Front;

use App\Entity\Like;
use App\Entity\Dislike;
use App\Repository\CarRepository;
use App\Repository\LikeRepository;
use App\Repository\DislikeRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    #[Route('/like/car/{id}', name: 'car_like')]
    public function likeCar(
        $id,
        CarRepository $carRepository,
        LikeRepository $likeRepository,
        DislikeRepository $dislikeRepository,
        EntityManagerInterface $entityManagerInterface
    ) {

        $car = $carRepository->find($id);
        $user = $this->getUser();

        if (!$user) {
            return $this->json(
                [
                    'code' => 403,
                    'message' => "Vous devez vous connecter"
                ],
                403
            );
        }

        if ($car->isLikeByUser($user)) {
            $like = $likeRepository->findOneBy(
                [
                    'car' => $car,
                    'user' => $user
                ]
            );

            $entityManagerInterface->remove($like);
            $entityManagerInterface->flush();

            return $this->json([
                'code' => 200,
                'message' => "Like supprimé",
                'likes' => $likeRepository->count(['car' => $car]),
                'dislikes' => $dislikeRepository->count(['car' => $car])
            ], 200);
        }

        $like = new Like();

        $like->setCar($car);
        $like->setUser($user);

        $entityManagerInterface->persist($like);
        $entityManagerInterface->flush();

        if ($car->isDislikeByUser($user)) {
            $dislike = $dislikeRepository->findOneBy(['car' => $car]);
            $entityManagerInterface->remove($dislike);
            $entityManagerInterface->flush();
        }

        return $this->json([
            'code' => 200,
            'message' => "Like ajouté",
            'likes' => $likeRepository->count(['car' => $car]),
            'dislikes' => $dislikeRepository->count(['car' => $car])
        ], 200);
    }

    #[Route('/dislike/car/{id}', name: 'car_dislike')]
    public function dislikeCar(
        $id,
        CarRepository $carRepository,
        DislikeRepository $dislikeRepository,
        likeRepository $likeRepository,
        EntityManagerInterface $entityManagerInterface
    ) {

        $car = $carRepository->find($id);
        $user = $this->getUser();

        if (!$user) {
            return $this->json(
                [
                    'code' => 403,
                    'message' => "Vous devez vous connecter"
                ],
                403
            );
        }

        if ($car->isDislikeByUser($user)) {
            $dislike = $dislikeRepository->findOneBy(
                [
                    'car' => $car,
                    'user' => $user
                ]
            );

            $entityManagerInterface->remove($dislike);
            $entityManagerInterface->flush();

            return $this->json([
                'code' => 200,
                'message' => "Like supprimé",
                'likes' => $likeRepository->count(['car' => $car]),
                'dislikes' => $dislikeRepository->count(['car' => $car])
            ], 200);
        }

        $dislike = new Dislike();

        $dislike->setCar($car);
        $dislike->setUser($user);

        $entityManagerInterface->persist($dislike);
        $entityManagerInterface->flush();

        if ($car->isLikeByUser($user)) {
            $like = $likeRepository->findOneBy(['car' => $car]);
            $entityManagerInterface->remove($like);
            $entityManagerInterface->flush();
        }

        return $this->json([
            'code' => 200,
            'message' => "Like ajouté",
            'dislikes' => $dislikeRepository->count(['car' => $car]),
            'likes' => $likeRepository->count(['car' => $car])
        ], 200);
    }
}
