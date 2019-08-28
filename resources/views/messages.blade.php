@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Messages
                <a class="navbar-brand" style="float:right" href="{{ route('messages.create') }}">
                   Create
                </a>
                </div>
                <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th> Name</th>
                        <th> Content </th>
                        <th> Date </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($messages as $message)
                <tr>
                    <td> {{ $message->user->name}}</td>
                    <td> {{ $message->content }} </td>
                    <td> {{ $message->created_at }} </td>
                </tr>
                @endforeach
                </tbody>
            </div>
        </div>
    </div>
</div>
@endsection