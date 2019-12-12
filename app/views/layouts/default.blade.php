<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ANONERG</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="/vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/app/public/css/app.css"/>
    @yield('css')

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="/vendor/components/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/be56a064b0.js" crossorigin="anonymous"></script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/app/public/js/jquery.mask.min.js"></script>
    <script src="/app/public/js/jquery.funcoes.js"></script>

    <script src="/app/public/js/sweetalert2.all.min.js"></script>
    @yield('scripts')
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand" href="/">
            <img src="https://www.anoreg.org.br/site/wp-content/images/logo-anoreg-300.png" width="30" height="30"
                 alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item{{App\Helpers\Helper::replaceUrl($_SERVER['REQUEST_URI']) ==='/inicio' ? ' active' : ''}}">
                    <a class="nav-link" href="/inicio">Início <span class="sr-only">(Página atual)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink"
                       href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Arquivos</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Importar</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/arquivos/upload/xml">XML</a></li>
                                <li><a class="dropdown-item" href="/arquivos/upload/excel">Excel</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="javascript:void(0)">Exportar</a>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item export-excel" href="javascript:void(0)">Excel</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item{{App\Helpers\Helper::replaceUrl($_SERVER['REQUEST_URI']) ==='/novo-email' ? ' active' : ''}}">
                    <a class="nav-link" href="/novo-email">Enviar e-mail</a>
                </li>
            </ul>
        </div>
    </nav>
    <section id="content">
        @yield('content')
    </section>
</div>

</body>
</html>
