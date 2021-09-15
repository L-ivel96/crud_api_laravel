@extends('layout')

@section('cabecalho')
    Editar Cliente
@endsection

@section('conteudo')
    <form id="form_cadastro">
        <input type="hidden" name="id" value="{{$id}}">
        <input type="hidden" name="token" value="{{$token}}">
        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" name="nome" id="nome" aria-describedby="Nome do cliente" placeholder="Nome do Cliente" required="required">
        </div>
        <div class="form-group">
            <label for="cpf_cnpj">CPF/CNPJ</label>
            <input type="text" class="form-control" name="cpf_cnpj" id="cpf_cnpj" aria-describedby="cpf ou cnpj do cliente" placeholder="CPF ou CNPJ do Cliente" required="required">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" id="editar">Editar</button>
            <a href="./listar_clientes" class="btn btn-primary">Voltar</a>
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: '../api/listar_cliente',
                type: 'POST',
                dataType: 'json',
                data: {id: {{$id}}, token: '{{$token}}'},
            })
            .done(function(dados) {
                console.log(dados);
                $("#nome").val(dados.nome);
                $("#cpf_cnpj").val(dados.cpf_cnpj);

            })
            .fail(function(erro) {
                console.log(erro);
            });

            $("#editar").click(function(event) {
                event.preventDefault();

                var dados = $("#form_cadastro").serialize();
                let nome_c = $("#nome").val();
                let cpf_cnpj_c = $("#cpf_cnpj").val();

                if(nome_c == "" || cpf_cnpj_c == "")
                {
                    alert("Todos os campos são obrigatórios");
                    return false;
                }

                $.ajax({
                    url: '../api/editar_cliente',
                    type: 'PUT',
                    dataType: 'json',
                    data: dados,
                })
                .done(function(dados) {
                    console.log("success");
                    window.location.href = "/listar_clientes"; 
                })
                .fail(function(erro) {
                    console.log(erro);
                    alert("Erro ao tentar Editar!")
                });
                return false;
            });

        });

    </script>
@endsection