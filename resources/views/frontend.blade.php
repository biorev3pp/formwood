<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ ($allsettings['app_title'])?$allsettings['app_title']:config('app.name', 'Laravel') }}</title>
    <meta name="url" content="{{ env('APP_URL') }}" />
    <meta name="media_url" content="{{ env('MEDIA_URL') }}" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ (isset($allsettings['application_favicon']) && $allsettings['application_favicon'])?env('MEDIA_URL').$allsettings['application_favicon']:asset('backend/images/favicon.jpg')}}">
    <link href="{{ asset('css/app.css') }}?v=8" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}?v=8" defer></script>
</head>
<body>
    <div id="app">
        <biorev-app />
    </div>
</body>
</html>
