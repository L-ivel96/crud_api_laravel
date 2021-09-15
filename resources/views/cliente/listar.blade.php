@extends('layout')

@section('cabecalho')
    Listar Clientes
@endsection

@section('conteudo')
    <div class="table-responsive">
        <table id="tabela_clientes" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4"><a href="./cadastrar_cliente" class="btn btn-info">Adicionar Cliente</a></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <script>
        var corpo_tabela = $("#tabela_clientes tbody");
        function carrega_dados()
        {
            $.ajax({
                url: './api/listar_cliente',
                type: 'POST',
                dataType: 'json',
                data: {token: '{{$token}}'},
            })
            .done(function(dados) {
                console.log(dados);

                $.each(dados, function() {
                    let linha = $("<tr></tr>");
                        linha.attr('id', this.id_cliente);
                    let coluna_nome = $("<td></td>");
                        coluna_nome.append(this.nome);
                    let coluna_cpf_cnpj = $("<td></td>");
                        coluna_cpf_cnpj.append(this.cpf_cnpj);

                    let link_editar = './editar_cliente/' + this.id_cliente;
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

                    linha.append(coluna_nome);
                    linha.append(coluna_cpf_cnpj);
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

            $.ajax({
                url: './api/excluir_cliente',
                type: 'DELETE',
                dataType: 'json',
                data: {id: id_linha, token: '{{$token}}'},
            })
            .done(function() {
                console.log("success");
                linha.remove();

            })
            .fail(function(error) {
                console.log(error);
            })
        }

    </script>
@endsection