    @if (\Auth::id() === $fakepost->user_id) 
    
    
     {{-- editボタンのフォーム --}}
    {!! link_to_route('fakeposts.edit', '投稿編集', [$fakepost->id], ['class' => 'btn-secondary btn-sm']) !!}
    @endif