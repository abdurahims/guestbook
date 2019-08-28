@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                
                    <div class="card-header">Reply to message</div>
                        <div style="padding: 10px;">
                            {{ $message->content }}
                        </div>

                        <div style="padding: 10px;">
                        {!! Form::open(['method'=>'POST', 'action'=>'MessagesController@store']) !!}
                        <div class="form-group">
                            {!! Form::label('content', 'Content') !!}
                            {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
                            {!! Form::hidden('link_message_id', $message->id) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Create message', ['class'=>'btn btn-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

            </div>
        </div>
    </div>
</div>
@endsection