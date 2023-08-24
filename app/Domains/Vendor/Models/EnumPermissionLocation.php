<?php

namespace App\Domains\Vendor\Models;


enum EnumPermissionLocation: string
{

    case view_cities = 'View Cities';

    case view_countries = 'View Countries';

    case view_states = 'View States';

}
