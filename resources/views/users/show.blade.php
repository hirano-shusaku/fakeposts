@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            {{-- ユーザ情報 --}}
            @include('users.card')
        </aside>
        <div class="col-sm-8">
            {{-- タブ --}}
            @include('users.navtabs')
                @if (Auth::id() == $user->id)
                {{-- 投稿フォーム --}}
                {{-- @include('fakeposts.form') --}}
                @include('fakeposts.create_button')
                @endif
                {{-- 投稿一覧 --}}
                @include('fakeposts.fakeposts')
        </div>
    </div>
@endsection