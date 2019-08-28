@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                
                    <div class="card-header">Edit a message</div>
                        <div style="padding: 10px;">
                        {!! Form::model($message, [ 'method'=>'PATCH', 'action'=>['MessagesController@update', $message->id] ]) !!}
                        
                        <div class="form-group">
                            {!! Form::label('content', 'Content') !!}
                            {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::submit('Save message', ['class'=>'btn btn-primary col-sm-4']) !!}
                        </div>
                        
                        {!! Form::close() !!}

                        {!! Form::open([ 'method'=>'DELETE', 'action'=>['MessagesController@destroy', $message->id] ]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete message', ['class'=>'btn btn-danger col-sm-4']) !!}
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