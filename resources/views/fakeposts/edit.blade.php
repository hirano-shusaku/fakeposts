@extends('layouts.app')

@section('content')
<h1>投稿編集ページ</h1>
    <div class="row">
        <div class="col-6">
            {!! Form::model($fakepost, ['route' => ['fakeposts.update', $fakepost->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::text('content', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection

   
        