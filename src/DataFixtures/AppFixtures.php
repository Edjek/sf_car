<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Car;
use App\Entity\User;
use App\Entity\Brand;
use App\Entity\Group;
use App\Entity\Image;
use App\Repository\CarRepository;
use App\Repository\BrandRepository;
use App\Repository\GroupRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    private $brandRepository;
    private $groupRepository;
    private $carRepository;

    public function __construct(BrandRepository $brandRepository, GroupRepository $groupRepository, CarRepository $carRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->groupRepository = $groupRepository;
        $this->carRepository = $carRepository;
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $brand = new Brand();

            $brand->setName($faker->company);
            $brand->setCountry($faker->country);

            $manager->persist($brand);
            $manager->flush();
        }

        for ($i = 0; $i < 10; $i++) {
            $group = new Group();

            $group->setName($faker->company);
            $group->setCountry($faker->country);

            $manager->persist($group);
            $manager->flush();
        }

        for ($i = 0; $i < 10; $i++) {
            $car = new Car();

            $id_brand = rand(1,10);
            $id_group = rand(1,10);

            $brand = $this->brandRepository->find($id_brand);
            $group = $this->groupRepository->find($id_group);

            $car->setName($faker->word);
            $car->setYear($faker->numberBetween(2000, 2021));
            $car->setEngine($faker->word);
            $car->setDescription($faker->text);
            $car->setBrand($brand);
            $car->setGroupe($group);

            $manager->persist($car);
            $manager->flush();
        }

        for ($i = 0; $i < 10; $i++) {
            $image = new Image();

            $id_car = rand(0, 10);

            $car = $this->carRepository->find($id_car);

            $image->setSrc($faker->imageUrl(640, 480, 'animals', true));
            $image->setTitle($faker->word);
            $image->setAlt($faker->word);
            $image->setCar($car);

            $manager->persist($image);
            $manager->flush();
        }

        for ($i = 0; $i < 10; $i++) {
            $user = new User();

            $user->setEmail($faker->email);
            $user->setRoles(["ROLE_USER"]);
            $user->setPassword($faker->password);

            $manager->persist($user);
            $manager->flush();
        }
    }
}
