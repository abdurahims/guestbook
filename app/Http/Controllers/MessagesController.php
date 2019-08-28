<?php

namespace App\Http\Controllers;

use Auth;
use App\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::all();        
        return view('messages', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);
        
        $input = $request->all();
        $user = Auth::user();
        $user->messages()->create($input);

        return redirect('messages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $message = Message::findOrFail($id);
        return view('admin.messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $user = Auth::user();
        if($user->hasPermissionTo('action all')){
            Message::findOrFail($id)->update($input);
            return redirect('/messages'); 
        }else{
            $user->messages()->whereId($id)->first()->update($input);
        }
        return redirect('/ownmessages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        if($user->hasPermissionTo('action all')){
            Message::findOrFail($id)->delete();
            return redirect('/messages'); 
        }else{
            $user->messages()->whereId($id)->first()->delete();
        }
        return redirect('ownmessages');
    }

    public function ownmessages(){

        $user = Auth::user();
        $messages = $user->messages;
        return view('ownmessages', compact('messages'));
    }
}
