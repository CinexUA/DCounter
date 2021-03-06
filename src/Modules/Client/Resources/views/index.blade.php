@php
    $config = [
        'appName' => config('app.name'),
        'locale' => $locale = app()->getLocale(),
        'locales' => \LaravelLocalization::getLocalesOrder(),
    ];
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ mix('css/client.css') }}">
</head>
<body>
<div id="app"></div>

{{-- Global configuration object --}}
<script>
    window.config = @json($config);
</script>

{{-- Load the application scripts --}}
<script src="{{ mix('js/client.js') }}"></script>
</body>
</html>
