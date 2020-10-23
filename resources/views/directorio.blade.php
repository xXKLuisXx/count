<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>Directorio de proveedores</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet"/>
    <style>
        #iconCheck:hover {
            background-color: #ed8c80;
        }
        .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid #eed3d7;
        border-radius: 4px;
        position: absolute;
        bottom: 0px;
        right: 21px;
        /* Each alert has its own width */
        float: right;
        clear: right;
        background-color: white;
        }

        .alert-red {
        color: white;
        background-color: #DA4453;
        }
        .alert-green {
        color: white;
        background-color: #37BC9B;
        }
        .alert-blue {
        color: white;
        background-color: #4A89DC;
        }
        .alert-yellow {
        color: white;
        background-color: #F6BB42;
        }
        .alert-orange {
        color:white;
        background-color: #E9573F;
        }
    </style>
</head>

<body class="antialiased"
    style="background: linear-gradient(130deg, rgba(242,169,132,1) 0%, rgba(232,109,123,1) 100%); position: fixed; background-attachment: fixed; width: 100%; height: 100%;">
    <iframe width="100%" height="100%" src="{{asset('directorio.pdf')}}" frameborder="0"></iframe>
</body>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>

</html>
