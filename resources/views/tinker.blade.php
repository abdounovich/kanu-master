<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>BotMan Studio</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        body {
            font-family: "Source Sans Pro", sans-serif;
            margin: 0;
            padding: 0;
            background: radial-gradient(#57bfc7, #45a6b3);
        }

        .container {
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }

        .content {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content" id="app">
        <botman-tinker api-endpoint="/botman"></botman-tinker>
    </div>
</div>


@php
    $type=new App\Type();
    $type->type='لحية';
    $type->prix='250';
    $type->temps='15';
    $type->point=10;
    $type->photo='https://res.cloudinary.com/ds9qfm1ok/image/upload/v1599380742/6a9e1200d5f747a7a8a8e2010ccb9f02_vwjebs.jpg';
$type->save();
@endphp

<script src="/js/app.js"></script>
</body>
</html>