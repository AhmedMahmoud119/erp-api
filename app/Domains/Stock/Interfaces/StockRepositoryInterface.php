<?php

namespace App\Domains\Stock\Interfaces;

use App\Domains\Stock\Models\Stock;



interface StockRepositoryInterface
{
    public function list();
    public function exportInventoryReport();
    public function generatePDF();
    public function inventoryReport();
    public function findById(string $id): Stock;
    public function store($request): bool;
    public function update(string $id, $request): bool;
    public function delete(string $id): bool;
}
