@extends('layout')

@section('cabecalho')
    Cadastrar Clientes
@endsection

@section('conteudo')
    <form id="form_cadastro">
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
            <button class="btn btn-primary" id="cadastrar">Cadastrar</button>
            <a href="./listar_clientes" class="btn btn-primary">Voltar</a>
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#cadastrar").click(function(event) {
                event.preventDefault();

                var dados = $("#form_cadastro").serialize();
                let nome_c = $("#nome").val();
                let cpf_cnpj_c = $("#cpf_cnpj").val();

                if(nome_c == "" || cpf_cnpj_c == "")
                {
                    swal({
                        title: "Ops!",
                        text: "Todos os campos são obrigatórios",
                        icon: "warning"
                    });
                    return false;
                }

                $.ajax({
                    url: './api/cadastrar_cliente',
                    type: 'POST',
                    dataType: 'json',
                    data: dados,
                })
                .done(function(dados) {
                    console.log(dados);
                    if(dados.id)
                    {
                        swal({
                            title: "Cadastrado!",
                            text: "Cadastro realizado com sucesso",
                            icon: "success"
                        });
                        window.location.href = "/listar_clientes";    
                    }
                    else
                    {
                        swal({
                            title: "Algo deu errado...",
                            text: "Erro ao tentar cadastrar, tente novamente",
                            icon: "error"
                        });
                    }

                })
                .fail(function(erro) {
                    swal({
                        title: "Algo deu errado...",
                        text: "Erro ao tentar cadastrar, tente novamente",
                        icon: "error"
                    });
                });
                return false;
            });

        });

    </script>
@endsection