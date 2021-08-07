<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
        {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
        <img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="">
    </div>
   
    <div class="alert alert-primary" role="alert">
        【年齢】：
        {{ $user->age }}
    </div>
    
    <div class="alert alert-danger" role="alert">
        【プロフィール】<br>
        {{ $user->profile }}
    </div>
    
    @include('user_follow.edit_button')  
    @include('user_follow.delite_button')  
        
</div>
{{-- フォロー／アンフォローボタン --}}
@include('user_follow.follow_button')