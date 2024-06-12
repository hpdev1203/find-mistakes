<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>@yield('title')</title>
		@vite(['resources/css/app.css','resources/js/app.js'])
		@livewireStyles
	</head>
	<body class="font-['Poppins'] bg-white leading-normal text-base tracking-normal">
        <div class="max-w-6xl m-auto">
            @yield('content')
        </div>
    </body>
    @livewireScripts
</html>