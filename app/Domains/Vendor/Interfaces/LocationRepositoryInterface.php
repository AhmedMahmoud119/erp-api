<?php

namespace App\Domains\Vendor\Interfaces;

use App\Domains\Vendor\Models\City;
use App\Domains\Vendor\Models\Country;
use App\Domains\Vendor\Models\State;

interface LocationRepositoryInterface
{
    public function findCityById(string $id): City;
    public function listCities();
    public function findCountryById(string $id): Country;
    public function listCountries();
    public function findStateById(string $id): State;
    public function listStates();
}
