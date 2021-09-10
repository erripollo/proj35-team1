<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use App\Apartment;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $apartments = Apartment::all();
        $user = Auth::user();
        $messages = DB::table('messages')
            ->join('apartments', 'messages.apartment_id', '=', 'apartments.id')
            ->join('users', 'apartments.user_id', '=', 'users.id')
            ->where('apartments.user_id', '=', $user->id)
            ->select(
                'messages.id',
                'messages.name',
                'messages.lastname', 
                'messages.apartment_id', 
                'apartments.title',
                'apartments.image',
                'apartments.address',
                'messages.email',
                'messages.body',  
                'messages.created_at')
            ->paginate(10);

            //dd($messages);


        return view('admin.messages.index', compact('user', 'messages', 'apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        

        $apartment_id = $message->apartment_id;
        $apartments = Apartment::where('id', '=', $apartment_id)->get();
        $apartment = $apartments[0];

        //dd($message, $apartment[0]);

        return view('admin.messages.show', compact('message', 'apartment'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
       
        $message->delete();
        
        return redirect()->route('admin.messages.index');
    }
}
