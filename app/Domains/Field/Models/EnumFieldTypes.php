<?php

namespace App\Domains\Field\Models;

enum EnumFieldTypes: string
{

    case text = 'Text';
    case checkbox = 'Checkbox';
    case radioButton = 'Radio Button';
    case fileUpload = 'File Upload';
    case rating = 'Rating';
    case dropdown = 'Dropdown';
    case textArea = 'TextArea';
    case toggleSwitch = 'Toggle Switch';
    case timePicker = 'Time Picker';
    case image = 'Image';
    case label = 'Label';
    case number = 'Number';

}
