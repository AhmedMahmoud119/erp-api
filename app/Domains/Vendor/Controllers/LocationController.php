<?php

namespace App\Domains\Vendor\Controllers;

use App\Domains\Vendor\Models\EnumPermissionLocation;
use App\Domains\Vendor\Resources\CityResource;
use App\Domains\Vendor\Resources\CountryResource;
use App\Domains\Vendor\Resources\StateResource;
use App\Domains\Vendor\Services\LocationService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;


class LocationController extends Controller
{
    public function __construct(private LocationService $locationService)
    {
    }

    public function listCities()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionLocation::view_cities->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return CityResource::collection($this->locationService->listCities());
    }
    public function listCountries()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionLocation::view_cities->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return CountryResource::collection($this->locationService->listCountries());
    }
    public function listStates()
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionLocation::view_cities->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return StateResource::collection($this->locationService->listStates());
    }
    public function findCityById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionLocation::view_cities->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CityResource($this->locationService->findCityById($id));
    }
    public function findCountryById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionLocation::view_cities->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CountryResource($this->locationService->findCountryById($id));
    }
    public function findStateById($id)
    {
        abort_if(!auth()->user()->hasPermissionTo(EnumPermissionLocation::view_cities->value, 'api'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new StateResource($this->locationService->findStateById($id));
    }

}
