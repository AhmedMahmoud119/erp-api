<?php

namespace App\Domains\Vendor\Repositories;

use App\Domains\Vendor\Interfaces\LocationRepositoryInterface;

use App\Domains\Vendor\Models\City;
use App\Domains\Vendor\Models\Country;
use App\Domains\Vendor\Models\State;

class LocationMySqlRepository implements LocationRepositoryInterface
{
    public function __construct(private City $city, private Country $country, private State $state)
    {
    }
    public function listCountries()
    {
        return $this->country::when(request()->search, function ($q) {
            $searchTerm = '%' . request()->search . '%';
            $q->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            });
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->with('states')->paginate(request('limit', config('app.pagination_count')));
    }
    public function listCities()
    {
        return $this->city::when(request()->search, function ($q) {
            $searchTerm = '%' . request()->search . '%';
            $q->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            });
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->paginate(request('limit', config('app.pagination_count')));
    }
    public function listStates()
    {
        return $this->state::when(request()->search, function ($q) {
            $searchTerm = '%' . request()->search . '%';
            $q->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            });
        })->when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->with('cities')->paginate(request('limit', config('app.pagination_count')));
    }
    public function findCityById($id): City
    {
        $city = $this->city::findOrFail($id);

        return $city;
    }
    public function findStateById($id): State
    {
        $state = $this->state::findOrFail($id);
        $state->load('cities');

        return $state;
    }
    public function findCountryById($id): Country
    {
        $country = $this->country::findOrFail($id);
        $country->load('states');
        return $country;
    }



}