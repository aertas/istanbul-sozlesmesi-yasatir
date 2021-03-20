<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>İstanbul Sözleşmesi Profil Resmini Güncelle</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,600" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/fav-icon.png') }}"/>
	<link href="{{ mix('assets/css/app.css') }}" rel="stylesheet">
</head>
<body>

@yield('content')

<script src="{{ mix('assets/js/app.js') }}"></script>
<script src="{{ mix('assets/js/vendor.js') }}"></script>
<script src="{{ mix('assets/js/site.js') }}"></script>
</body>
</html>
