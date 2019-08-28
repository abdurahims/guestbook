@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Messages
                <a class="navbar-brand" style="float:right" href="{{ route('messages.create') }}">
                   Create
                </a>
                </div>
                @if($messages->count() > 0)
                <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th> Name</th>
                        <th> Content </th>
                        <th> Created </th>
                        <th> Actions </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                <tr>
                    <td> {{ $message->user->name}}</td>
                    <td> {{ $message->content }} </td>
                    <td> {{ $message->created_at->diffForhumans() }} </td>
                    <td> 
                    @if(empty($message->link_message_id))
                    <a href="{{ route('messages.edit', $message->id ) }}">Edit</a>
                    @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
                </table>
                @else
                    <div style="padding:10px">
                        No messages found
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection