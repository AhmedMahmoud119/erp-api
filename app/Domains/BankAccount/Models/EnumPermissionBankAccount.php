<?php

namespace App\Domains\BankAccount\Models;


enum EnumPermissionBankAccount: string
{

    case create_bankAccount = 'Create BankAccount';
    case edit_bankAccount = 'Edit BankAccount';
    case delete_bankAccount = 'Delete BankAccount';
    case view_bankAccounts = 'View BankAccounts';

}
