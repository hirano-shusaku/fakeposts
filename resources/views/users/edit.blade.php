@extends('layouts.app')

@section('content')
<h1>user編集ページ</h1>
    <div class="row">
        <div class="col-6">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('age', '年齢:') !!}
                    {!! Form::number('age', null, ['class' => 'form-control', 'placeholder' => 'null', 'min' => 0, 'max' => 99]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('profile', 'プロフィール:') !!}
                    {!! Form::text('profile', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection