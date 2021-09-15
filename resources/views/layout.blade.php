<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('cabecalho')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/funcoes.js')}}"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light mb-2 d-flex justify-content-between" style="background-color: #e9ecef;">
        <h2>@yield('cabecalho')</h2>
        <div class="d-flex justify-content-around">
            <a class="navbar-brand" href="{{ route('listar_cliente') }}">Clientes</a>
            <a class="navbar-brand" href="{{ route('listar_produto') }}">Produtos</a>
            <?php //<a class="navbar-brand" href="{{ route('listar_cliente') }}">Vendas</a> ?>
        </div>
    </nav>
    <div class="container">
        @yield('conteudo')
    </div>
</body>
</html>