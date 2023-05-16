<?php

namespace App\Domains\Field\Models;

enum EnumSomeRequirements: string
{
    case required = 'Required';
    case used_in_filter = 'Used in Filter';
    case unique= 'Unique';

}
