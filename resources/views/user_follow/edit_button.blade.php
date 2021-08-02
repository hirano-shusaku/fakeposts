    @if (Auth::id() === $user->id)

     {{-- editボタンのフォーム --}}
    {!! link_to_route('users.edit', 'ユーザー編集ボタン', [$user->id], ['class' => 'btn-warning btn-sm']) !!}
    @endif