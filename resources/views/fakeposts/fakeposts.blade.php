@if (count($fakeposts) > 0)
    <ul class="list-unstyled">
        @foreach ($fakeposts as $fakepost)
            <li class="media mb-3">
                {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                <img class="mr-2 rounded" src="{{ Gravatar::get($fakepost->user->email, ['size' => 50]) }}" alt="">
                <div class="media-body">
                    <div>
                        {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                        {!! link_to_route('users.show', $fakepost->user->name, ['user' => $fakepost->user->id]) !!}
                        <span class="text-muted">posted at {{ $fakepost->created_at }}</span>
                    </div>
                    <div>
                        {{-- 投稿内容 --}}
                        <p class="mb-0">{!! nl2br(e($fakepost->content)) !!}</p>
                    </div>
                    <div class="d-flex flex-row">
                        @if (Auth::id() == $fakepost->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['fakeposts.destroy', $fakepost->id], 'method' => 'delete']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                        {{-- like／アンlikeボタン --}}
                        @include('postlike.like_button')
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $fakeposts->links() }}
@endif