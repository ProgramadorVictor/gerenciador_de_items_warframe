<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Warframe - Gerenciador de Estoque</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/template.css') }}">     
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body style="background-color:#143548;  ">
    <section class="d-flex">
        @include('componentes.modal.modal-venda')
        <div style="box-shadow: 5px 0px 0px rgba(0, 0, 0, 0.1);">
            @include('componentes.sidebar.sidebar')
        </div>
        <div class="main-page" style="box-shadow: 15px 15px 0px rgba(0, 0, 0, 0.1);">
            <h6 class="text-center fw-bolder p-3 my-0 text-white bg-purple">INVENTÁRIO</h6>
            @yield('conteudo')
        </div>
        <div class="d-flex align-items-center"">
            <button class="d-flex justify-content-center btn" style="background-color: #9BC3B8;">REQ</button>
            {{-- O BOTAO DEVE PUXAR OS DADOS EM INTERVALO DE 5 MINUTOS QUANDO ATIVADO, O BOTAO FICA PRESSIONADO, PUXANDO OS DADOS A CADA 5 MINUTOS --}}
        </div>
        <div class="itens-page">
            <h6 class="text-center fw-bolder p-2 my-0">ITENS DO JOGO</h6>
            @include('componentes.itens.itens')
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
