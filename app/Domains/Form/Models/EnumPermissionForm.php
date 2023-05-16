<?php

namespace App\Domains\Form\Models;


enum EnumPermissionForm: string
{

    case create_form = 'Create Form';
    case edit_form = 'Edit form';
    case delete_form = 'Delete form';
    case view_forms = 'View forms';
    case fill_form = 'Fill Form';
    case versionDetails_form = 'VersionDetails Form';
    case addField_form = 'AddField Form';
    case listFormVersions_form = 'listFormVersions Form';
    case viewResponses_form = 'ViewResponses Form';
    case export_form = 'Export Form';
    case hideFormField_form = 'HideFormField Form';
    case deleteFormField_form = 'DeleteFormField Form';
    case viewFields_form = 'ViewFields Form';


}
