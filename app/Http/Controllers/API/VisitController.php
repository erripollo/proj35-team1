<?php

namespace App\Http\Controllers\API;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Visit;
use App\Apartment;
use App\Http\Resources\VisitResource;

class VisitController extends Controller
{
    public function stats(Request $request)
    {
        
        $query = $request->query();
        $id = $query['id'];

        $views = Visit::where('apartment_id', '=', $id)
        ->get();
        
        $stats = [];

        foreach ($views as $view) {

            $dateString = $view->created_at;
            $date = explode("-", $dateString);
            [$year, $month, $day] = $date;
            $stats[$year] []= $month;
        };

        return response() -> json($stats, 200);

    }
}
