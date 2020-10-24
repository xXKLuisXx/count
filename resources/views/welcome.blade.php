<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>Entradas</title>

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
                <div class="flex items-center border-b border-pink-400 py-2" style="position: absolute; right: 0;">
                    <input id="tokenValue" type="text" placeholder="Token"
                        class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none">
                    <button id="tokenManual"
                        class="flex-shrink-0 bg-pink-400 hover:bg-pink-600 border-pink-400 hover:border-pink-600 text-sm border-4 text-white py-1 px-2 rounded"
                        type="button">
                        Nuevo
                    </button>
                </div>
            </div>
        </nav>
    </div>
    <main class="mt-10 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28"
        style="text-align-last: center">
        <div class="sm:text-center lg:text-left">
            <h2 id="tokenId"
                class="text-4xl tracking-tight leading-10 font-extrabold text-pink-800 sm:text-5xl sm:leading-none md:text-6xl" style="display: none;">
                Token
            </h2>
            <br>
            <h3
                class="text-2xl tracking-tight leading-10 font-extrabold text-black sm:text-3xl sm:leading-none md:text-4xl">
                <span id="freeId" class="text-white">0</span> <span class="text-white">Disponibles</span>
            </h3>
            <h2
                class="text-4xl tracking-tight leading-10 font-extrabold text-black sm:text-5xl sm:leading-none md:text-6xl">
                <span id="counterId" class="text-white">0</span> <span class="text-white">Asistentes</span>
            </h2>
            <h3
                class="text-2xl tracking-tight leading-10 font-extrabold text-black sm:text-3xl sm:leading-none md:text-4xl">
                <span id="aforoTotal" class="text-white">0</span> <span class="text-white">Aforo total</span>
            </h3>
            <h4 class="text-5xl">
                <i id="iconCheck" class="fas fa-angle-double-up"></i>
            </h4>
        </div>
    </main>
    <div id="ohsnap"></div>
</body>
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
<script defer>
    let sumCount = 1;
    let entry = true
    let token = "";

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
        inicializarContadores();
        setInterval(inicializarContadores, 60000);
        let tokenText = document.getElementById("tokenId");
        let counterText = document.getElementById("counterId");
        let freeText = document.getElementById("freeId");
        let aforoTotal = document.getElementById("aforoTotal");
        let iconClass = document.getElementById("iconCheck");
        let inputToken = document.getElementById("tokenValue");
        var numeros="0123456789";
        var letras="abcdefghijklmnñopqrstuvwxyz";

        document.addEventListener("keydown", function(e) {
            char = e.which || e.keyCode;
            var key = e.keyCode;

            /*console.log("char "+String.fromCharCode(char))
            console.log("e "+e.which || e.keyCode)
            console.log("key "+key)*/

            if(key == 20 || key == 144){
                console.log("caracter especial")
            } else if(key >= 96 && key <= 105){
                switch(key){
                    case 96:
                        token += '0';
                    break;
                    case 97:
                        token += '1';
                    break;
                    case 98:
                        token += '2';
                    break;
                    case 99:
                        token += '3';
                    break;
                    case 100:
                        token += '4';
                    break;
                    case 101:
                        token += '5';
                    break;
                    case 102:
                        token += '6';
                    break;
                    case 103:
                        token += '7';
                    break;
                    case 104:
                        token += '8';
                    break;
                    case 105:
                        token += '9';
                    break;
                }
            }
            else if (key == 13) {
                sumCountRequest(token);
                tokenText.textContent = token;
                token = "";
            } else if(tiene_numeros(String.fromCharCode(char)) || tiene_letras(String.fromCharCode(char))){
                token += String.fromCharCode(char);
            } else {
                // nada
            }
        });

        jQuery('#iconCheck').click(function(e) {
            if (sumCount > 0) {
                iconClass.classList.remove("fa-angle-double-up");
                iconClass.classList.add("fa-angle-double-down");
                sumCount = -1;
            } else {
                iconClass.classList.remove("fa-angle-double-down");
                iconClass.classList.add("fa-angle-double-up");
                sumCount = 1;
            }

        });

        jQuery("#tokenManual").click(function(e) {
            e.preventDefault();
            sumCountRequest(inputToken.value);
            tokenText.textContent = inputToken.value;
            inputToken.value = "";
        });

        function tiene_numeros(texto){
            for(i=0; i<texto.length; i++){
                if (numeros.indexOf(texto.charAt(i),0)!=-1){
                    return 1;
                }
            }
            return 0;
        }

        function tiene_letras(texto){
            texto = texto.toLowerCase();
            for(i=0; i<texto.length; i++){
                if (letras.indexOf(texto.charAt(i),0)!=-1){
                    return 1;
                }
            }
            return 0;
        }

        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }

        function sumCountRequest(tokenVar) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ route('counter.store') }}",
                method: 'POST',
                data: {
                    token: tokenVar,
                    count: sumCount,
                },
                success: function(result) {
                    if(result.status=='success'){
                        toastr.success(result.mensaje)
                    } else {
                        toastr.error(result.mensaje)
                    }
                    freeText.innerText = formatNumber(result.free);
                    counterText.innerText = formatNumber(result.counter);
                    aforoTotal.innerText = formatNumber(result.aforoTotal);
                }
            });
        }

        function inicializarContadores(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "contadores",
                method: 'POST',
                data: {
                },
                success: function(result) {
                    freeText.innerText = formatNumber(result.free);
                    counterText.innerText = formatNumber(result.counter);
                    aforoTotal.innerText = formatNumber(result.aforoTotal);
                }
            });
        }
    });

</script>

</html>
