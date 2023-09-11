<?php

namespace App\Domains\Stock\Services;


use App\Domains\Stock\Interfaces\StockRepositoryInterface;

class StockService
{
    public function __construct(private StockRepositoryInterface $stockRepository)
    {
    }
    public function findById($id)
    {
        return $this->stockRepository->findById($id);
    }

    public function list()
    {
        return $this->stockRepository->list();
    }

    public function delete($id)
    {
        return $this->stockRepository->delete($id);
    }

    public function create($request)
    {
        return $this->stockRepository->store($request);
    }

    public function update($id, $request)
    {
        return $this->stockRepository->update($id, $request);
    }
    public function exportInventoryReport()
    {
        return $this->stockRepository->exportInventoryReport();
    }
    public function generatePDF()
    {
        return $this->stockRepository->generatePDF();
    }
    public function inventoryReport()
    {
        return $this->stockRepository->inventoryReport();
    }
    public function exportFile($extension)
    {
        switch (strtoupper($extension)) {
            case 'PDF':
                $this->generatePDF();
                break;
            case 'CSV':
                $this->exportInventoryReport();
                break;
            default:
                //return false
                break;
        }
    }
}