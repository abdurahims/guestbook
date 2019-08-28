@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Messages
                @auth
                <a class="navbar-brand" style="float:right" href="{{ route('messages.create') }}">
                   Create
                </a>
                @endauth
                </div>
                @if($messages->count() > 0)
                    <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th> Name</th>
                            <th> Content </th>
                            <th> Created </th>
                            @can('action all')
                            <th> Actions </th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $message)
                        <tr>
                        @if($message->user->hasRole('administrator'))
                        <td> Administrator</td>
                        @else
                        <td> {{ $message->user->name}}</td>
                        @endif
                        <td> {{ $message->content }} </td>
                        <td> {{ $message->created_at->diffForhumans() }} </td>
                        @can('action all')
                        <td> 
                            <a href="{{ route('messages.edit', $message->id ) }}">Edit</a>
                            @if($message->user_id != Auth::user()->id)
                            <a href="{{ route('messages.reply', $message->id) }}" style="float:right; padding-right:10px">Reply</a>
                            @endif
                        </td>
                        @endcan
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