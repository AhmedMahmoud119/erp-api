<?php

namespace App\Domains\Vendor\Services;


use App\Domains\Vendor\Interfaces\LocationRepositoryInterface;

class LocationService
{
    public function __construct(private LocationRepositoryInterface $locationRepository)
    {
    }

    public function listCountries()
    {
        return $this->locationRepository->listCountries();

    }
    public function listCities()
    {
        return $this->locationRepository->listCities();
    }
    public function listStates()
    {
        return $this->locationRepository->listStates();
    }
    public function findCityById($id)
    {
        return $this->locationRepository->findCityById($id);
    }
    public function findStateById($id)
    {
        return $this->locationRepository->findStateById($id);
    }
    public function findCountryById($id)
    {
        return $this->locationRepository->findCountryById($id);
    }

}