<form method="post" action="{{ route('logout') }}">
@csrf
    <button type="submit">ログアウト</button>
</form>
