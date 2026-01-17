<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('images/icon.png')}}" type="image/x-icon">
    <title>@yield('title')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-K42SJSN9GG"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function($){
            $('#telefone').mask('(00) 0 0000-0000');
            $('#cpf').mask('000.000.000-00');
            $('#salario').mask('#.###,##', {reverse: true});
        });
    </script>
</head>
<body class="d-flex flex-nowrap min-vh-100">
    <x-sidebar/>
    <main class="container-fluid p-4 bg-light">
        <div class="bg-white p-3 shadow h-100">
            @yield('content')
        </div>
    </main>
</body>
</html>

