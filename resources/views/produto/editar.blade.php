@extends('layout')

@section('cabecalho')
    Cadastrar Produtos
@endsection

@section('conteudo')
    <form id="form_cadastro">
        <input type="hidden" name="token" value="{{$token}}">
        <input type="hidden" name="id" value="{{$id}}">
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
            <button class="btn btn-primary" id="editar">Editar</button>
        </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajax({
                url: '../api/listar_produto',
                type: 'POST',
                dataType: 'json',
                data: {id: {{$id}}, token: '{{$token}}'},
            })
            .done(function(dados) {
                console.log(dados);
                $("#produto").val(dados.produto);
                $("#descricao").val(dados.descricao);
                $("#valor").val(dados.valor);
                $("#quantidade_estoque").val(dados.quantidade_estoque);

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
                    url: '../api/editar_produto',
                    type: 'PUT',
                    dataType: 'json',
                    data: dados,
                })
                .done(function(dados) {
                    console.log("success");
                    window.location.href = "../pagina_listar_produto"; 

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