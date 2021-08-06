@extends('layouts.app')
@section('content')
{!! Form::open(['route' => 'fakeposts.store']) !!}
    <div class="form-group">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '8', 'placeholder' => 'ここに好きな投稿を入力して、下のPOSTボタンで投稿してください']) !!}
        {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
{!! Form::close() !!}
@endsection