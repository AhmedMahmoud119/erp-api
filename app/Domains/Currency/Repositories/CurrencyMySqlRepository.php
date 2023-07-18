<?php

namespace App\Domains\Currency\Repositories;

use App\Domains\Currency\Interfaces\CurrencyRepositoryInterface;
use App\Domains\Currency\Models\Currency;
use App\Domains\Currency\Models\EnumCurrencies;
use Illuminate\Database\Eloquent\Collection;
use AshAllenDesign\LaravelExchangeRates\ExchangeRate;
use Guzzle\Http\Exception\ClientErrorResponseException;
use carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyMySqlRepository implements CurrencyRepositoryInterface
{

    public function __construct(private Currency $currency)
    {
    }

    public function list()
    {
        return $this->currency::when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['name', 'code', 'symbol', 'price', 'created_at', 'price_rate'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
            $q->orderBy('name', 'asc');
        })->when(request()->search, function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%')->orwhere('code', 'like',
                    '%' . request()->search . '%')->orwhere('symbol', 'like',
                    '%' . request()->search . '%')->orwhere('price_rate', 'like',
                    '%' . request()->search . '%')->orwhere('price', 'like', '%' . request()->search . '%');
        })->when(request()->from, function ($q) {
                $q->whereDate('created_at', '>=', request()->from);
            })->when(request()->to, function ($q) {
                $q->whereDate('created_at', '<=', request()->to);
            })->when(request()->name, function ($q) {
                $q->where('name', request()->name);
            })->when(request()->code, function ($q) {
                $q->where('code', request()->code);
            })->when(request()->price_rate, function ($q) {
                $q->where('price_rate', request()->price_rate);
            })->when(request()->creator_id, function ($q) {
                $q->where('creator_id', request()->creator_id);
            })->with('creator')
            //            ->orderBy('name', 'asc')
            ->paginate(request('limit',config('app.pagination_count')));
    }

    public function findById(string $id): Currency
    {
        return $this->currency::findOrFail($id);
    }

    public function store($request, $price): bool
    {
        $code = DB::table('currency_codes')->where('code', '=', $request->code)->first();
        $currencies = Currency::get();
        $this->currency::create([
            'name'           => $request->name,
            'code'           => $request->code,
            'symbol'         => $code->symbol,
            'price_rate'     => $request->price_rate,
            'default'        => count($currencies) === 0 ? 1 : 0,
            'creator_id'     => auth()->user()->id,
            'price'          => $price,
            'backup_changes' => $request->price_rate === 'Official' ? $request->backup_changes : null,
            'from'           => $request->backup_changes === 'Custom' ? $request->from : null,
            'to'             => $request->backup_changes === 'Custom' ? $request->to : null,
        ]);

        return true;
    }

    public function update(string $id, $request, $price): bool
    {
        $currency = $this->currency::findOrFail($id);
        $code = DB::table('currency_codes')->where('code', '=', $request->code)->first();
        $default = $request->default;
        if ($default == '1') {
            Currency::where("id", "!=", $id)->update(["default" => 0]);
        }
        if ($default == '0' && $currency->default == '1') {
            return false;
        }
        $currency->update([
            'name'           => $request->name,
            'code'           => $request->code,
            'symbol'         => $code->symbol,
            'price_rate'     => $request->price_rate,
            'default'        => $request->default,
            'creator_id'     => auth()->user()->id,
            'price'          => $price,
            'backup_changes' => $request->price_rate === 'Official' ? $request->backup_changes : null,
            'from'           => $request->backup_changes === 'Custom' ? $request->from : null,
            'to'             => $request->backup_changes === 'Custom' ? $request->to : null,
        ]);

        return true;
    }

    public function delete(string $id): bool
    {
        $this->currency::findOrFail($id)?->delete();

        return true;
    }
}
