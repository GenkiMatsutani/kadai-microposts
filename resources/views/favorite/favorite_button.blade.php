@php
$user = Auth::user(); // ログインユーザーを取得

// ログインユーザーが特定のMicropostをお気に入りに登録しているかをチェック
$favorite = $user->favorites->contains($micropost->id);
@endphp

@if($micropost)
    {{-- お気に入りを外すボタンのフォーム --}}
    <form method="POST" action="{{ route('favorites.unfavorite', ['user' => $user->id, 'micropost' => $micropost->id]) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-error btn-block normal-case" 
            onclick="return confirm('id = {{ $user->id }} のお気に入りを外します。よろしいですか？')">UnFavorite</button>
    </form>
@else
    {{-- お気に入りボタンのフォーム --}}
    <form method="POST" action="{{ route('favorites.favorite', ['user' => $user->id, 'micropost' => $micropost->id]) }}">
        @csrf
        <button type="submit" class="btn btn-primary btn-block normal-case">Favorite</button>
    </form>
@endif
