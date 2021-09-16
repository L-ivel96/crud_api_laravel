@extends('layout')

@section('cabecalho')
    Cadastrar Produtos
@endsection

@section('conteudo')
    <form id="form_cadastro">
        <input type="hidden" name="token" value="{{$token}}">
        <div class="form-group">
            <label for="produto">Produto</label>
            <input type="text" class="form-control" name="produto" id="produto" aria-describedby="Nome do produto" placeholder="Nome do produto" required="required">
        </div>
        <div class="form-group">
            <label for="descricao">Descricao</label>
            <input type="text" class="form-control" name="descricao" id="descricao" aria-describedby="Descrição do Produto" placeholder="Descrição do Produto">
        </div>
        <div class="form-group">
            <label for="valor">Valor(R$)</label>
            <input type="number" class="form-control" name="valor" id="valor" aria-describedby="Valor(R$)" placeholder="Valor(R$)" required="required">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" id="cadastrar">Cadastrar</button>
            <a href="/listar_produto" class="btn btn-primary">Voltar</a>
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#cadastrar").click(function(event) {
                event.preventDefault();

                var dados = $("#form_cadastro").serialize();

                $("#gif_carregando").css('display', 'block');
                $.ajax({
                    url: './api/cadastrar_produto',
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
                        window.location.href = "/listar_produto";    
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
                })
                .always(function() {
                    $("#gif_carregando").css('display', 'none');
                });
                
            });

        });

    </script>
@endsection