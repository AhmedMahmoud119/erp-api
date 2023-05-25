<?php

namespace App\Domains\Currency\Services;


use App\Domains\Currency\Interfaces\CurrencyRepositoryInterface;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CurrencyService
{
    public function __construct(private CurrencyRepositoryInterface $currencyRepository)
    {
    }

    public function list()
    {
        return $this->currencyRepository->list();
    }
    public function findById($id)
    {
        return $this->currencyRepository->findById($id);
    }

    public function delete($id)
    {
        return $this->currencyRepository->delete($id);
    }

    public function create($request)
    {
        if($request->price_rate=='Official') {
            $from = $request->code;
            $res= Http::get("https://free.currconv.com/api/v7/convert?q=".$from."_EGP&compact=ultra&apiKey=4e169e31d96998e3238f");
//            https://api.fastforex.io/fetch-multi?from=$from&to=EGP&api_key=fbfbb16c96-732ab3eb69-rut2z7
            $price=$res[$from.'_EGP'];

        }
        else {
            $price=$request->price;
        }
        return $this->currencyRepository->store($request,$price);
    }

    public function update($id,$request)
    {
        if($request->price_rate=='Official') {
            $from = $request->code;
            $res= Http::get("https://free.currconv.com/api/v7/convert?q=".$from."_EGP&compact=ultra&apiKey=4e169e31d96998e3238f");
            $price=$res[$from.'_EGP'];

        }
        else {
            $price=$request->price;
        }
        return $this->currencyRepository->update($id,$request,$price);
    }
}
