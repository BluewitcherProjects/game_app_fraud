<script src="{{ asset('js/toast.js') }}"></script>

@if (session()->has('notify'))
    @foreach (session('notify') as $msg)
        <script>
            message("{{ __($msg[1]) }}")
        </script>
    @endforeach
@endif

@if ($errors->any())
    @php
        $collection = collect($errors->all());
        $errors = $collection->unique();
    @endphp

    <script>
        @foreach ($errors as $error)
            message('{{ __($error) }}')
        @endforeach
    </script>
@endif
