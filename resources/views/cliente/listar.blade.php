@extends('layout')

@section('cabecalho')
    Listar Clientes
@endsection

@section('conteudo')
    <div class="table-responsive">
        <table id="tabela_clientes" class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>Nome</th>
                    <th>CPF/CNPJ</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">
                        <a href="./cadastrar_cliente" class="btn btn-info">
                            Adicionar Cliente
                            <i class="fas fa-user-plus"></i>
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
                            class: 'btn btn-warning mb-1 mr-2',
                            href: link_editar
                        });
                        btn_editar.html('Editar <i class="fas fa-edit"></i>');

                    let btn_excluir = $("<a></a>");
                        btn_excluir.attr('class', 'btn btn-danger mb-1 mr-2');
                        btn_excluir.html('Excluir <i class="fas fa-trash-alt"></i>');
                        btn_excluir.click(deleta_linha);

                    let coluna_acao = $("<td class='text-center'></td>");
                        coluna_acao.append(btn_editar);
                        coluna_acao.append(btn_excluir);

                    linha.append(coluna_nome);
                    linha.append(coluna_cpf_cnpj);
                    linha.append(coluna_acao);

                    corpo_tabela.append(linha);

                });
                
            })
            .fail(function(erro) {
                swal({
                    title: "Erro!",
                    text: "Não foi possível carregar os clientes, verifique sua conexão e tente novamente!",
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
                        url: './api/excluir_cliente',
                        type: 'DELETE',
                        dataType: 'json',
                        data: {id: id_linha, token: '{{$token}}'},
                    })
                    .done(function() {
                        linha.remove();

                    })
                    .fail(function(error) {
                        console.log(error);
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