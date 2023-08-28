<?php

namespace App\Domains\PaymentType\Models;


enum EnumPermissionPaymentType: string
{

    case create_paymentType = 'Create PaymentType';
    case edit_paymentType = 'Edit PaymentType';
    case delete_paymentType = 'Delete PaymentType';
    case view_paymentType = 'View PaymentType';

}
