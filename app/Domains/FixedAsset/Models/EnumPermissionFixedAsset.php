<?php

namespace App\Domains\FixedAsset\Models;


enum EnumPermissionFixedAsset: string
{

    case create_FixedAsset = 'Create Fixed Asset';
    case edit_FixedAsset = 'Edit Fixed Asset';
    case delete_FixedAsset = 'Delete Fixed Asset';
    case view_FixedAssets = 'View Fixed Assets';



}
