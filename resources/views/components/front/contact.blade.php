<div class="contact">
    <div class="contact_title">/*CONTACT*/</div>
    <form action="{{ route('front.contact.confirm') }}" method="POST" target="_blank" rel="noopener noreferrer">
    @csrf
        <p>
            <label for="name">NAME</label><br>
            <input type="text" name="name" size="40" value="{{ old('name') }}">
            @if ($errors->has('name'))
            <p>{{ $errors->first('name') }}</p>
            @endif
        </p>
        <p>
            <label for="email">MAIL-ADRESS</label><br>
            <input type="email" name="email" size="40" value="{{ old('email') }}">
            @if ($errors->has('email'))
            <p>{{ $errors->first('email') }}</p>
            @endif
        </p>
        <p>
            <label for="title">TITLE</label><br>
            <input type="text" name="title" size="40" value="{{ old('title') }}">
            @if ($errors->has('title'))
            <p>{{ $errors->first('title') }}</p>
            @endif
        </p>
        <p>
            <label for="contents">CONTENTS</label><br>
            <textarea name="contents" cols="40" rows="10" value="{{ old('contents') }}"></textarea>
            @if ($errors->has('contents'))
            <p>{{ $errors->first('contents') }}</p>
            @endif
        </p>
        <p>
            <input type="submit" value="CONFIRM">
        </p>
    </form>
</div>
