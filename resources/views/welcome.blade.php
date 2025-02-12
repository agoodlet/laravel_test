<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <!-- Styles -->
    </head>
    <body class="antialiased">
<form method="post" action="#">
@method('delete')
@csrf
<input type="text" />
<button type="submit">Submit</button>
</form>
</body>

