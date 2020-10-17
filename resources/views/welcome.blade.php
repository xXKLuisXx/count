<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>Entradas</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
</head>

<body class="antialiased">
    <div class="relative bg-white overflow-hidden">
        <div class="max-w-screen-xl mx-auto">
            <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
                    fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <polygon points="50,0 100,0 50,100 0,100" />
                </svg>

                <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
                    <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start">
                        <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                            <div class="flex items-center justify-between w-full md:w-auto">
                                <a aria-label="Home">
                                    <img class="h-8 w-auto sm:h-10"
                                        src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg" alt="Logo">
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
                        <div class="hidden md:block md:ml-10 md:pr-4">
                            <a id="cambiar"
                                class="font-medium text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out">Cambiar</a>
                            
                            <input id="tokenValue" class="bg-gray-200 text-gray-700 border border-red-500 rounded leading-tight focus:outline-none focus:bg-white" id="grid-first-name" type="text" placeholder="Token">
                            <a id="tokenManual" class="ml-8 font-medium text-indigo-600 hover:text-indigo-900 transition duration-150 ease-in-out">Nuevo</a>
                        </div>
                    </nav>
                </div>
                <div class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
                    <div class="rounded-lg shadow-md">
                        <div class="rounded-lg bg-white shadow-xs overflow-hidden" role="menu"
                            aria-orientation="vertical" aria-labelledby="main-menu">
                            <div class="px-5 pt-4 flex items-center justify-between">
                                <div>
                                    <img class="h-8 w-auto"
                                        src="https://tailwindui.com/img/logos/workflow-mark-on-white.svg" alt="">
                                </div>
                                <div class="-mr-2">
                                    <button type="button"
                                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                        aria-label="Close menu">
                                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="px-2 pt-2 pb-3">
                                <a href="#"
                                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out"
                                    role="menuitem">Product</a>
                                <a href="#"
                                    class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out"
                                    role="menuitem">Features</a>
                                <a href="#"
                                    class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out"
                                    role="menuitem">Marketplace</a>
                                <a href="#"
                                    class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:text-gray-900 focus:bg-gray-50 transition duration-150 ease-in-out"
                                    role="menuitem">Company</a>
                            </div>
                            <div>
                                <a href="#"
                                    class="block w-full px-5 py-3 text-center font-medium text-indigo-600 bg-gray-50 hover:bg-gray-100 hover:text-indigo-700 focus:outline-none focus:bg-gray-100 focus:text-indigo-700 transition duration-150 ease-in-out"
                                    role="menuitem">
                                    Log in
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <main class="mt-10 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h2 id="tokenId"
                            class="text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
                            Token
                        </h2>
                        <br>
                        <h2 class="text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl">
                            <span id="counterId" class="text-indigo-600">0</span><i id="iconCheck" class="fas fa-angle-double-up"></i>
                        </h2>
                    </div>
                    
                </main>
            </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
            <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
                src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2850&q=80"
                alt="">
        </div>
    </div>
</body>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
<script defer>
    let sumCount = 1;
    let entry = true
    let token = "";
    $(document).ready(function() {
        let tokenText = document.getElementById("tokenId");
        let counterText = document.getElementById("counterId");
        let iconClass = document.getElementById("iconCheck");
        let inputToken = document.getElementById("tokenValue");
        document.addEventListener("keydown", function(e) {
            //e.preventDefault();
            char = e.which || e.keyCode;
            var key = e.keyCode;
            token += String.fromCharCode(char);
            if (key == 13) {
                sumCountRequest(token);
                tokenText.textContent = token;
                console.log(token);
                token = "";
            }
        });

        jQuery('#cambiar').click(function(e) {
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
                    counterText.innerText = result;
                }
            });
        }
    });

</script>

</html>
