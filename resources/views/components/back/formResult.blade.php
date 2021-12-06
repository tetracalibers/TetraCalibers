@if (session('message'))
<div class="alert _success">
    {{ session('message') }}
    <span class="-close">×</span>
</div>
@endif

@if (session('error'))
<div class="alert _warming">
    {{ session('error') }}
    <span class="-close">×</span>
</div>
@endif

@if ($errors->any())
@foreach ($errors->all() as $error)
<div class="alert _warming">
    {{ $error }}
    <span class="-close">×</span>
</div>
@endforeach
@endif
