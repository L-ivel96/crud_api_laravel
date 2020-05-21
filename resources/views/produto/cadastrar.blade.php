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
            <label for="quantidade_estoque">Quantidade em estoque</label>
            <input type="number" class="form-control" min="0" name="quantidade_estoque" id="quantidade_estoque" aria-describedby="Quantidade em estoque" placeholder="Quantidade em estoque" required="required">
        </div>
        <div class="form-group">
            <button class="btn btn-primary" id="cadastrar">Cadastrar</button>
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#cadastrar").click(function(event) {
                event.preventDefault();

                var dados = $("#form_cadastro").serialize();

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
                        window.location.href = "./pagina_listar_produto";    
                    }
                    else
                    {
                        alert("Erro ao tentar cadastrar, tente novamente. Todos os campos deve ser preenchidos");
                    }

                })
                .fail(function(erro) {
                    console.log(erro);
                    alert("Erro ao tentar cadastrar!")
                });
            });

        });

    </script>
@endsection