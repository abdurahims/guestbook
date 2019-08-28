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
        $posted_messages = Message::whereNull('link_message_id')->get();

        $message_ids = $posted_messages->pluck('id')->toArray();
        $replies = Message::whereIn('link_message_id', $message_ids )->get();

        $messages = new \Illuminate\Support\Collection();

        foreach($posted_messages as $posted_message){
            $messages->push($posted_message);
            foreach($replies as $reply){
                if($posted_message->id == $reply->link_message_id){
                    $messages->push($reply);
                }
            }
        }
        
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
        $replies = Message::where('link_message_id', $id)->get();
        $user = Auth::user();
        if($user->hasPermissionTo('action all')){
            Message::findOrFail($id)->delete();
            foreach($replies as $reply){
                $reply->delete();
            }
            return redirect('/messages'); 
        }else{
            $user->messages()->whereId($id)->first()->delete();
            foreach($replies as $reply){
                $reply->delete();
            }
        }
        return redirect('ownmessages');
    }

    public function ownmessages(){

        $user = Auth::user();
        $posted_messages = $user->messages;

        $message_ids = $posted_messages->pluck('id')->toArray();
        $replies = Message::whereIn('link_message_id', $message_ids )->get();

        $messages = new \Illuminate\Support\Collection();

        foreach($posted_messages as $posted_message){
            $messages->push($posted_message);
            foreach($replies as $reply){
                if($posted_message->id == $reply->link_message_id){
                    $messages->push($reply);
                }
            }
        }
        return view('ownmessages', compact('messages'));
    }

    public function reply($id){
        $message = Message::findOrFail($id);
        return view('admin.messages.reply', compact('message'));
    }
}
