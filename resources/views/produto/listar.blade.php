@extends('layout')

@section('cabecalho')
    Listar Produtos
@endsection

@section('conteudo')
    <div class="table-responsive">
        <table id="tabela_clientes" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Valor (R$)</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <a href="./cadastrar_produto" class="btn btn-info">
                            Adicionar Produto
                            <i class="fas fa-plus-circle"></i>
                        </a>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <script>
        var corpo_tabela = $("#tabela_clientes tbody");
        function carrega_dados()
        {
            $("#gif_carregando").css('display', 'block');

            $.ajax({
                url: './api/listar_produto',
                type: 'POST',
                dataType: 'json',
                data: {token: '{{$token}}'},
            })
            .done(function(dados) {

                $.each(dados, function() {
                    let linha = $("<tr></tr>");
                        linha.attr('id', this.id_produto);
                    let coluna_produto = $("<td></td>");
                        coluna_produto.append(this.produto);
                    let coluna_descricao = $("<td></td>");
                        coluna_descricao.append(this.descricao);
                    let coluna_valor = $("<td></td>");
                        coluna_valor.append(this.valor.toLocaleString('pt-br', {minimumFractionDigits: 2}));

                    let link_editar = './editar_produto/' + this.id_produto;
                    let btn_editar = $("<a></a>");
                        btn_editar.attr({
                            class: 'btn btn-warning mb-1 mr-2',
                            href: link_editar
                        });
                        btn_editar.html('Editar <i class="fas fa-edit"></i>');

                    let btn_excluir = $("<a></a>");
                        btn_excluir.attr('class', 'btn btn-danger mb-1 mr-2');
                        btn_excluir.attr('href', '#');
                        btn_excluir.html('Excluir <i class="fas fa-trash-alt"></i>');
                        btn_excluir.click(deleta_linha);

                    let coluna_acao = $("<td class='text-center'></td>");
                        coluna_acao.append(btn_editar);
                        coluna_acao.append(btn_excluir);

                    linha.append(coluna_produto);
                    linha.append(coluna_descricao);
                    linha.append(coluna_valor);
                    linha.append(coluna_acao);

                    corpo_tabela.append(linha);

                });
                
            })
            .fail(function(erro) {
                swal({
                    title: "Erro!",
                    text: "Não foi possível carregar os produtos, verifique sua conexão e tente novamente!",
                    icon: "error"
                });
            })
            .always(function() {
                $("#gif_carregando").css('display', 'none');
            });
            
        }

        $(document).ready(function() {
            carrega_dados();
        });

        function deleta_linha()
        {
            let linha = $(this).parent().parent();
            let id_linha = linha.attr('id');

            swal({
                title: "Atenção!",
                text: "A exclusão é permanente, deseja excluir registro?",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    cancel: {
                        text: "Cancelar",
                        value: null,
                        visible: true,
                        className: ""
                    },
                    confirm: {
                        text: "Excluir",
                        value: true,
                        visible: true,
                        className: ""
                    }
                },
            })
            .then((escolha) => {
                if (escolha) {
                    $("#gif_carregando").css('display', 'block');
                    
                    $.ajax({
                        url: './api/excluir_produto',
                        type: 'DELETE',
                        dataType: 'json',
                        data: {id: id_linha, token: '{{$token}}'},
                    })
                    .done(function() {
                        linha.remove();

                    })
                    .fail(function(error) {
                        swal({
                            title: "Erro",
                            text: "Não foi possível excluir o registro!",
                            icon: "error"
                        });
                    })
                    .always(function() {
                        $("#gif_carregando").css('display', 'none');
                    });

                }
            });
            
        }

    </script>
@endsection