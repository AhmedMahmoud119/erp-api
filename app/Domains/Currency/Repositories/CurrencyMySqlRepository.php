<?php

namespace App\Domains\Currency\Repositories;

use App\Domains\currency\Interfaces\CurrencyRepositoryInterface;
use App\Domains\Currency\Models\Currency;
use Illuminate\Database\Eloquent\Collection;

class CurrencyMySqlRepository implements CurrencyRepositoryInterface
{
    public function __construct(private Currency $currency)
    {
    }


    public function list()
    {
        return $this->currency::all();
//        ->paginate(config('app.pagination_count'));
    }
    public function findById(string $id) :Currency
    {
        return $this->currency::findOrFail($id);
    }

    public function store($request):bool
    {
        $price_rate=$request->price_rate;
        $backup_changes=$request->backup_changes;
        if($price_rate=='Official'&&$backup_changes=='Custom'){

            $this->currency::create([
            'name' => $request->name ,
            'code' => $request->code ,
            'symbol' => $request->symbol ,
            'price_rate' => $request->price_rate ,
            'custom_price' => $request->custom_price,
            'backup_changes' => $request->backup_changes,
            'from' => $request->from,
            'to' => $request->to ,
            'default' => $request->default,
            'creator_id' => auth()->user()->id ,
        ]);}
        elseif($price_rate=='Official'&&$backup_changes!='Custom'){  $this->currency::create([
            'name' => $request->name ,
            'code' => $request->code ,
            'symbol' => $request->symbol ,
            'price_rate' => $request->price_rate ,
            'custom_price' => $request->custom_price,
            'backup_changes' => $request->backup_changes,
            'from' => null,
            'to' =>null,
            'default' => $request->default,
            'creator_id' => auth()->user()->id ,
        ]);}
        else{   $this->currency::create([
            'name' => $request->name ,
            'code' => $request->code ,
            'symbol' => $request->symbol ,
            'price_rate' => $request->price_rate ,
            'custom_price' => $request->custom_price,
            'backup_changes' => null,
            'from' => null,
            'to' => null,
            'default' => $request->default,
            'creator_id' => auth()->user()->id ,
        ]);
        }


        return true;
    }

    public function update(string $id, $request):bool
    {

        $currency = $this->currency::findOrFail($id);
        $price_rate=$request->price_rate;
        $backup_changes=$request->backup_changes;
        if($price_rate=='Official'&&$backup_changes=='Custom')
        {
            $currency->update([
                'name' => $request->name ??$currency->name ,
                'code' => $request->code ??$currency->code ,
                'symbol' => $request->symbol ??$currency->symbol ,
                'price_rate' => $request->price_rate ?? $currency->price_rate  ,
                'custom_price' => $request->custom_price ?? $currency->custom_price  ,
                'backup_changes' => $request->backup_changes ?? $currency->backup_changes ,
                'from' => $request->from ?? $currency->from  ,
                'to' => $request->to ?? $currency->to  ,
                'default' => $request->default ?? $currency->default ,
            ]);

        }
        elseif($price_rate=='Official'&&$backup_changes!='Custom')
        {
            $currency->update([
                'name' => $request->name ??$currency->name ,
                'code' => $request->code ??$currency->code ,
                'symbol' => $request->symbol ??$currency->symbol ,
                'price_rate' => $request->price_rate ?? $currency->price_rate  ,
                'custom_price' => $request->custom_price ?? $currency->custom_price  ,
                'backup_changes' => $request->backup_changes ?? $currency->backup_changes ,
                'from' => null,
                'to' =>null,
                'default' => $request->default ?? $currency->default ,
            ]);

        }
        else{
        $currency->update([
            'name' => $request->name ??$currency->name ,
            'code' => $request->code ??$currency->code ,
            'symbol' => $request->symbol ??$currency->symbol ,
            'price_rate' => $request->price_rate ?? $currency->price_rate  ,
            'custom_price' => $request->custom_price ?? $currency->custom_price  ,
            'backup_changes' => null,
            'from' => null,
            'to' => null,
            'default' => $request->default ?? $currency->default ,
        ]);
        }

        return true;
    }

    public function delete(string $id): bool
    {
        $this->currency::findOrFail($id)?->delete();
        return true;
    }
}
