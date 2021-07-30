     @if (Auth::user()->is_likeing($fakepost->id))
        {{-- アンフォローボタンのフォーム --}}
        {!! Form::open(['route' => ['post.unlike', $fakepost->id], 'method' => 'delete']) !!}
            {!! Form::submit('Unlike', ['class' => "btn btn-danger btn-sm"]) !!}
        {!! Form::close() !!}
    @else
        {{-- フォローボタンのフォーム --}}
        {!! Form::open(['route' => ['post.like', $fakepost->id]]) !!}
            {!! Form::submit('Like', ['class' => "btn btn-primary btn-sm"]) !!}
        {!! Form::close() !!}
    @endif

