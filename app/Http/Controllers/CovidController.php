<?php

namespace App\Http\Controllers;

use App\Events\addedDataEvent;
use Carbon\Carbon;
use App\Models\Covid;
use App\Models\Countries;
use Illuminate\Http\Request;

class CovidController extends Controller
{
    public function realTimeChart()
    {
        $country = Countries::findOrFail(20);
        $data = Covid::where('country_id', 20)->latest('date')->limit(20)->get();

        // $data = Covid::where('country_id', 20)->limit(20)->orderBy('date', 'desc')->get();

        $country = Countries::where('id', 20)->first();

        // return response()->json([

        //     'country' => $country->name,
        //     'labels' => $data->pluck('date')->toArray(),
        //     'Confirmed' => $data->pluck('Confirmed')->toArray(),
        // ]);
        return response()->json([
            'country' => $country->name,
            'labels' => $data->pluck('date')->toArray(),
            'data' => [
                'Confirmed' => $data->pluck('Confirmed')->toArray(),
            ],
        ]);
    }

    public function addData()
    {
        $date = Carbon::now()->startOfDay();

        for ($i = 1; $i <= 100; $i++) {
            $item = new Covid();
            $item->country_id = 20;
            $item->date = $date->toDateString();
            $item->Confirmed = rand(0, 200);
            $item->Deaths = rand(0, 100);
            $item->Recovered = rand(0, 100);
            $item->Active = rand(0, 100);
            $item->save();

            $date->addDay();
            event(new addedDataEvent('Indonesia', $item->date, $item->Confirmed));
            sleep(2);
        }
    }
}
