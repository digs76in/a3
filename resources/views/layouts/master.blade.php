<!DOCTYPE html>
<html>
<head>
	<title>
        @yield('title', 'A3')
    </title>

	<meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'>
	<link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/flatly/bootstrap.min.css' rel='stylesheet'>
	

    @stack('head')

</head>
<body>
    <div class="container">
         @yield('content')
    </div>
</body>
</html>