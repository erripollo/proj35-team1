<?php

namespace App\Http\Controllers\API;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\Apartment;
use App\Http\Resources\VisitResource;

class MessageController extends Controller
{
    public function stats(Request $request)
    {
        $query = $request->query();
        $id = $query['id'];

        $messages = Message::where('apartment_id', '=', $id)
        ->get();
        
        $stats = [];

        foreach ($messages as $message) {

            $dateString = $message->created_at;
            $date = explode("-", $dateString);
            [$year, $month, $day] = $date;
            $stats[$year] []= $month;
        };

        return response() -> json($stats, 200);

    }
}
