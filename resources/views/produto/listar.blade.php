@extends('layout')

@section('cabecalho')
    Listar Produtos
@endsection

@section('conteudo')
    <div class="table-responsive">
        <table id="tabela_clientes" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th>Valor (R$)</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6"><a href="./cadastrar_produto" class="btn btn-info">Adicionar Produto</a></td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <script>
        var corpo_tabela = $("#tabela_clientes tbody");
        function carrega_dados()
        {
            $.ajax({
                url: './api/listar_produto',
                type: 'POST',
                dataType: 'json',
                data: {token: '{{$token}}'},
            })
            .done(function(dados) {
                console.log(dados);

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
                            class: 'btn btn-warning',
                            href: link_editar
                        });
                        btn_editar.append("Editar");

                    let btn_excluir = $("<a></a>");
                        btn_excluir.attr('class', 'btn btn-danger');
                        btn_excluir.append("Excluir");
                        btn_excluir.click(deleta_linha);

                    let coluna_editar = $("<td></td>");
                        coluna_editar.append(btn_editar);

                    let coluna_deletar = $("<td></td>");
                        coluna_deletar.append(btn_excluir);

                    linha.append(coluna_produto);
                    linha.append(coluna_descricao);
                    linha.append(coluna_valor);
                    linha.append(coluna_editar);
                    linha.append(coluna_deletar);

                    corpo_tabela.append(linha);

                });
                
            })
            .fail(function(erro) {
                console.log(erro);
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
                    });
                }
            });
            
        }

    </script>
@endsection