<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="{{asset(mix('css/app.css'))}}">
    <link rel="stylesheet" href="http://esotericsoftware.com/files/spine-player/3.8/spine-player.css">
    <script src="http://esotericsoftware.com/files/spine-player/3.8/spine-player.js"></script>
</head>
<body>

<div id="app">
    <example-component></example-component>
</div>
</body>

<script src="{{asset(mix('js/app.js'))}}"></script>
</html>
