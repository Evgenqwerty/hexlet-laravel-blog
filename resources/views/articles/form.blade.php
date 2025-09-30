@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{  html()->label('имя', 'name') }}
{{  html()->input('text', 'name') }}
{{  html()->label('Содержание', 'body') }}
{{  html()->textarea('body') }}
