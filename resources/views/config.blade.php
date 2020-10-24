<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>Configuración de Entradas</title>

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
    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
        <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start">
            <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                <div class="flex items-center justify-between w-full md:w-auto">
                    <a aria-label="Home">
                        <img class="h-8 w-auto sm:h-10" src="{{ asset('Logo.png') }}" alt="Logo">
                    </a>
                    <div class="-mr-2 flex items-center md:hidden">
                        <button type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            id="main-menu" aria-label="Main menu" aria-haspopup="true">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="hidden md:flex md:ml-10 md:pr-4">
                <!--
                <div>
                    <button id="cambiar" class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="button">
                        cambiar
                    </button>
                </div>
                -->
                <div class="flex items-center border-b text-white py-2" style="position: absolute; left: 0;">
                    <label for="tokenValue">Aforo</label>
                    <input id="tokenValue" type="text" placeholder="Aforo"
                        class="appearance-none bg-transparent border-none focus:outline-none leading-tight mr-3 px-2 py-1 w-full" value="{{$conf->aforo}}">
                    <button id="guardarConfig"
                        class="flex-shrink-0 bg-pink-400 hover:bg-pink-600 border-pink-400 hover:border-pink-600 text-sm border-4 text-white py-1 px-2 rounded"
                        type="button">
                        Actualizar Información de aforo
                    </button>
                    <button id="nuevoDia"
                        class="ml-2 flex-shrink-0 bg-pink-400 hover:bg-pink-600 border-pink-400 hover:border-pink-600 text-sm border-4 text-white py-1 px-2 rounded"
                        type="button">
                        Iniciar un nuevo dia
                    </button>
                    <button id="importarData"
                    class="ml-2 flex-shrink-0 bg-pink-400 hover:bg-pink-600 border-pink-400 hover:border-pink-600 text-sm border-4 text-white py-1 px-2 rounded"
                    type="button">
                        Importar Información de staff
                    </button>
                </div>
            </div>
        </nav>
    </div>
</body>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/ohsnap.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
<script defer>
    toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }
    $(document).ready(function() {
        let inputToken = document.getElementById("tokenValue");

        jQuery("#nuevoDia").click(function(e) {
            e.preventDefault();
            nuevoDia();
        });

        jQuery("#importarData").click(function(e) {
            e.preventDefault();
            importarData()
        });

        jQuery("#guardarConfig").click(function(e) {
            e.preventDefault();
            guardarInformacion(inputToken.value);
        });

        function nuevoDia(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "newDia",
                method: 'POST',
                data: {
                },
                success: function(result) {
                    if(result.status=='success'){
                        toastr.success(result.mensaje)
                        //ohSnap(result.mensaje, {color: 'green'})
                    } else {
                        toastr.error(result.mensaje)
                        //ohSnap(result.mensaje, {color: 'red'})
                    }
                }
            });
        }

        function importarData(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "https://brideadvisor.mx/api/exportData",
                method: 'POST',
                data: {
                    'event_id': 12
                },
                success: function(result) {
                    jQuery.ajax({
                        url: "importarData",
                        method: 'POST',
                        data: {
                            'provider': result.providers,
                            'staff': result.staff
                        },
                        success: function(result) {
                            if(result.status=='success'){
                                toastr.success(result.mensaje)
                                //ohSnap(result.mensaje, {color: 'green'})
                            } else {
                                toastr.error(result.mensaje)
                                //ohSnap(result.mensaje, {color: 'red'})
                            }
                        }
                    });
                    if(result.status=='success'){
                        toastr.success(result.mensaje)
                        //ohSnap(result.mensaje, {color: 'green'})
                    } else {
                        toastr.error(result.mensaje)
                        //ohSnap(result.mensaje, {color: 'red'})
                    }
                }
            });
        }

        function guardarInformacion(tokenVar) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "saveData",
                method: 'POST',
                data: {
                    aforo: tokenVar
                },
                success: function(result) {
                    if(result.status=='success'){
                        toastr.success(result.mensaje)
                        //ohSnap(result.mensaje, {color: 'green'})
                    } else {
                        toastr.error(result.mensaje)
                        //ohSnap(result.mensaje, {color: 'red'})
                    }
                }
            });
        }
    });

</script>

</html>
