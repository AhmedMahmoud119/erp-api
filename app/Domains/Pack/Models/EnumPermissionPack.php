<?php

namespace App\Domains\Pack\Models;


enum EnumPermissionPack: string
{

    case create_pack = 'Create Pack';
    case edit_pack = 'Edit Pack';
    case delete_pack = 'Delete Pack';
    case view_packs = 'View Packs';

}