<?php

namespace App\Domains\RevisionHistory\Models;


enum EnumPermissionRevisionHistory: string
{

    case create_revisionHistory = 'Create Revision History';
//    case edit_revisionHistory = 'Edit Revision History';
//    case delete_revisionHistory = 'Delete Revision History';
    case view_revisionHistories = 'View Revision History';

}
