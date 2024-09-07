@component('mail::layout')
    {{-- Header --}}
    @slot ('header')
        @component('mail::header', ['url' => config('app.url')])
            <!-- header -->
        @endcomponent
    @endslot

    {{-- Content --}}
    <h1>{{ $title }}</h1>
    <p>{{ $message }}</p>

    {{-- Subcopy --}}
    @slot('subcopy')
        @component('mail::subcopy')
            <!-- Additional instructions here if needed -->
        @endcomponent
    @endslot

    {{-- Footer --}}
    @slot ('footer')
        @component('mail::footer')
            <!-- footer -->
        @endcomponent
    @endslot
@endcomponent
