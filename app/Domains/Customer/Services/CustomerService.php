<?php

namespace App\Domains\Customer\Services;


use App\Domains\BankAccount\Exports\BankAccountsExport;
use App\Domains\Customer\Exports\SalesReportExport;
use App\Domains\Customer\Interfaces\CustomerRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class CustomerService
{
    public function __construct(private CustomerRepositoryInterface $customerRepository)
    {
    }

    public function list()
    {
        return $this->customerRepository->list();
    }
    public function findById($id)
    {
        return $this->customerRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->customerRepository->delete($id);
    }

    public function create($request)
    {
        return $this->customerRepository->store($request);
    }

    public function update($id,$request)
    {
        return $this->customerRepository->update($id,$request);
    }

    public function salesReport($request)
    {
        return $this->customerRepository->salesReport();
    }

    public function salesReportExportCSV($request)
    {
        $filename = time() . '-salesReport.csv';
        $path = 'exports/salesReport/' . $filename;
        Excel::store(new SalesReportExport(), $path, 'public');

        return response()->json([
            'file_path' => asset('storage/'.$path)
        ]);
    }

    public function salesReportExportPDF($request)
    {
        $salesReport = $this->salesReport($request);


        $data = [
            'title'        => 'Sales Report',
            'date'         => date('m/d/Y'),
            'salesReport' => $salesReport,
        ];
        $pdf = PDF::loadView('SalesReportPDF', $data);

        $path = public_path('storage/');
        $fileName = time() . '-salesReport.pdf';
        $pdf->save($path . $fileName);

        return response()->json([
            'file_path' => asset('storage/' . $fileName),
        ]);
    }
}
