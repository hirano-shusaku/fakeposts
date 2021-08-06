    @if (Auth::id() === $user->id)

     {{-- deliteボタンのフォーム --}}
    {!! link_to_route('users.delete_confirm', 'ユーザー退会ボタン', [$user->id], ['class' => 'btn-secondary btn-sm']) !!}
    @endif