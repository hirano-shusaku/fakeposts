@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                {{-- ユーザ情報 --}}
                @include('users.card')
            </aside>
            <div class="col-sm-8">
                {{-- 投稿フォーム --}}
                @include('fakeposts.form')
                {{-- 投稿一覧 --}}
                @include('fakeposts.fakeposts')
            </div>
        </div>
        @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Welcome to the Fakeposts</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection


