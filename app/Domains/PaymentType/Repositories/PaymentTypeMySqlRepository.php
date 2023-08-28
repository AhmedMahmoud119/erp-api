<?php

namespace App\Domains\PaymentType\Repositories;

use App\Domains\PaymentType\Interfaces\PaymentTypeRepositoryInterface;
use App\Domains\PaymentType\Models\PaymentType;

class PaymentTypeMySqlRepository implements PaymentTypeRepositoryInterface
{

    public function __construct(private PaymentType $paymentType)
    {
    }

    public function findById(string $id): PaymentType
    {
        $paymentType = $this->paymentType::findOrFail($id);

        return $paymentType;
    }

    public function list()
    {
        return $this->paymentType::when(request()->from, function ($q) {
            $q->whereDate('created_at', '>=', request()->from);
        })->when(request()->to, function ($q) {
            $q->whereDate('created_at', '<=', request()->to);
        })->paginate(request('limit', config('app.pagination_count')));
    }

    public function store($request): bool
    {
        $this->paymentType::create([
            'name'        => $request->name,
        ]);
        return true;
    }

    public function update(string $id, $request): bool
    {
        $paymentType = $this->paymentType::findOrFail($id);
        $paymentType->update([
            'name'        => $request->name,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $this->paymentType::findOrFail($id)?->delete();

        return true;
    }
}
