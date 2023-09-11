<?php

namespace App\Domains\Stock\Models;


enum EnumPermissionStock: string
{
    case create_stock = 'Create Stock';
    case edit_stock = 'Edit Stock';
    case delete_stock = 'Delete Stock';
    case view_stocks = 'View Stocks';
    case view_reports = 'View Report';
    case export_report_file = 'Export Report File';
}