<?php

namespace App\Domains\Group\Models;


enum EnumPermissionGroup: string
{

    case create_group = 'Create Group';
    case edit_group = 'Edit Group';
    case delete_group = 'Delete Group';
    case view_groups = 'View Groups';
    case generatePDF_groups = 'Generate PDF groups';
    case export_groups = 'Export groups';
    case import_groups = 'Import groups';



}
