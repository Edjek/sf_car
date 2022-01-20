<?php

namespace App\Globals;

use App\Repository\BrandRepository;

class Brands
{
    private $brandRepository;

    public function __construct(BrandRepository $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAll()
    {
        $brands = $this->brandRepository->findAll();
        return $brands;
    }
}
