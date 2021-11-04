<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento[]|\Cake\Collection\CollectionInterface $lancamentos
 */
?>
<?php $this->assign('title', __('Lancamentos')); ?>


<script>
    function realizado() {
        document.getElementById('real').style.display = 'block';
        document.getElementById('prev').style.display = 'none';
    }

    function previsto() {
        document.getElementById('real').style.display = 'none';
        document.getElementById('prev').style.display = 'block';
    }
</script>

<style>
    .tr1 a {
        color: #7A3E26;
    }

    .nm a {
        color: #7A3E26;
    }

    .dataTables_info{
        color: #CF6856;
    }

    .dataTables_empty{
        color: #7A3E26;
    }

    .dataTables_filter input:focus {
      color: #7A3E26;
      border: #CF6856 solid 2px;

    }
    .dataTables_filter input{
      color: #7A3E26;
      border: #CF6856 solid 2px;

    }

    .dataTables_filter label{
      color: #7A3E26;

    }

    .but {
        background-color: #FFFFFF;
        color: #7A3E26;
        border: 1px solid #7A3E26;
        opacity: 0.7;
    }

    .but:hover {
        background-color: #7A3E26;
        color: #FFFFFF;
        border: 1px solid #FFFFFF;
        opacity: 0.7;
    }

    .buttons-copy {
        background-color: #FFFFFF;
        color: #7A3E26;
        border: 1px solid #7A3E26;
        opacity: 0.7;
    }

    .buttons-copy:hover {
        background-color: #7A3E26;
        color: #FFFFFF;
        border: 1px solid #FFFFFF;
        opacity: 0.7;
    }

    .buttons-print {
        background-color: #FFFFFF;
        color: #7A3E26;
        border: 1px solid #7A3E26;
        opacity: 0.7;
    }

    .buttons-print:hover {
        background-color: #7A3E26;
        color: #FFFFFF;
        border: 1px solid #FFFFFF;
        opacity: 0.7;
    }

    .buttons-csv {
        background-color: #FFFFFF;
        color: #7A3E26;
        border: 1px solid #7A3E26;
        opacity: 0.7;
    }

    .buttons-csv:hover {
       background-color: #7A3E26;
        color: #FFFFFF;
        border: 1px solid #FFFFFF;
        opacity: 0.7;
    }

    .buttons-excel {
        background-color: #FFFFFF;
        color: #7A3E26;
        border: 1px solid #7A3E26;
        opacity: 0.7;
    }

    .buttons-excel:hover {
        background-color: #7A3E26;
        color: #FFFFFF;
        border: 1px solid #FFFFFF;
        opacity: 0.7;
    }

    .buttons-pdf {
        background-color: #FFFFFF;
        color: #7A3E26;
        border: 1px solid #7A3E26;
        opacity: 0.7;
    }

    .buttons-pdf:hover {
        background-color: #7A3E26;
        color: #FFFFFF;
        border: 1px solid #FFFFFF;
        opacity: 0.7;
    }

    .buttons-collection {
        background-color: #FFFFFF;
        color: #7A3E26;
        border: 1px solid #7A3E26;
        opacity: 0.7;
    }

    .buttons-collection:hover {
        background-color: #7A3E26;
        color: #FFFFFF;
        border: 1px solid #FFFFFF;
        opacity: 0.7;
    }

    .vis:hover {
        background-color: #FFFFFF;
        color: #7A3E26;
        border: 1px solid #7A3E26;
        opacity: 0.9;

    }

    .vis {
        background-color: #7A3E26;
        color: #FFFFFF;
        border: 1px solid #FFFFFF;
        opacity: 0.9;

    }

    .edi:hover {
        background-color: #FFFFFF;
        color: #7A3E26;
        border: 1px solid #7A3E26;
        opacity: 0.8;

    }

    .edi {
        background-color: #7A3E26;
        color: #FFFFFF;
        border: 1px solid #FFFFFF;
        opacity: 0.8;

    }

    .del:hover {
        background-color: #FFFFFF;
        color: #CF6856;
        border: 1px solid #CF6856;
        opacity: 0.9;

    }

    .del {
        background-color: #CF6856;
        color: #FFFFFF;
        border: 1px solid #FFFFFF;
        opacity: 0.9;

    }

    /* li .page-link{
        background-color: #F7E7CE;
        color: #7A3E26;
        border: #7A3E26 1px solid;
    }

    li .active .page-link{
        background-color: #F7E7CE;
        color: #7A3E26;
        border: #7A3E26 1px solid;
    }

    li .disabled .page-link{
        background-color: #F7E7CE;
        color: #7A3E26;
        border: #7A3E26 1px solid;
    } */


    li{
        color: #7A3E26;
    }

    li a{
        color: #7A3E26;
    }

    .nl{
        float: left;
    }


</style>

<div class="card">
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead class="nm">
                <tr style="color: #CF6856;">

                    <th><?= __('Tipo') ?></th>
                    <th><?= __('Descrição') ?></th>
                    <th><?= __('Valor') ?></th>
                    <th><?= __('Data de Emissão') ?></th>
                    <th><?= __('Data de Baixa') ?></th>
                    <th><?= __('Data de Vencimento') ?></th>
                    <th><?= __('Conta') ?></th>
                    <th><?= __('Fornecedor') ?></th>
                    <th><?= __('Cliente') ?></th>
                    <th><?= __('Ações') ?></th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($lancamentos as $lancamento) :
                    // debug($lancamento->id_lancamento);
                    ?>
                        <tr style="color: #7A3E26;">
                            <td><?= h($lancamento->tipo) ?></td>
                            <td><?= h($lancamento->descricao) ?></td>
                            <td><?= $this->Number->format($lancamento->valor) ?></td>
                            <td><?= h($lancamento->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                            <?php if (empty($lancamento->data_baixa)) { ?>
                                <td><?= h($lancamento->data_baixa) ?></td>
                            <?php } else { ?>
                                <td><?= h($lancamento->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                            <?php } ?>
                            <td><?= h($lancamento->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>

                            <td class="tr1"><?= $lancamento->has('fluxoconta') ? $this->Html->link($lancamento->fluxoconta->conta, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->fluxoconta->conta]) : '' ?></td>
                            <td class="tr1"><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->nome, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->fornecedore->nome]) : '' ?></td>
                            <td class="tr1"><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->nome, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->cliente->nome]) : '' ?></td>
                            <td class="actions">
                                <div class="btn-group">
                                    <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_baixa == null)) { ?>
                                        <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-dark ']) ?>
                                    <?php } ?>
                                    <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_vencimento->i18nFormat('yyyy-MM-dd', 'UTC') < $now) && ($lancamento->data_baixa == null)) { ?>
                                        <?= $this->Html->link(__('Renovar'), ['controller' => 'Lancamentos', 'action' => 'renovar', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-secondary ']) ?>
                                    <?php } ?>
                                    <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $lancamento->id_lancamento], ['class' => 'vis btn btn-xs', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $lancamento->id_lancamento], ['class' => 'edi btn btn-xs', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('Deletar'), ['action' => 'delete', $lancamento->id_lancamento], ['class' => 'del btn btn-xs', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $lancamento->tipo)]) ?>
                                </div>

                            </td>


                    <?php endforeach; ?>
            </tbody>

        </table>

    </div>
</div>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "language": {
                "emptyTable":     "Nenhum registro disponível na tabela",
                "zeroRecords":    "Nenhum registro encontrado",
                "info": "Mostrando _START_ de _END_ dos _TOTAL_ lançamentos",
                "infoEmpty":      "Mostrando 0 de 0 dos 0 lançamentos",
                "infoFiltered":   "(filtrado do total de _MAX_ lançamentos)",
                "search": "Procurar:",
                "paginate": {
                    "first":      "Primeiro",
                    "last":       "Último",
                    "next":       "Próximo",
                    "previous":   "Anterior"
    },
             },

            columns: [{
                    data: 'Tipo'
                },
                {
                    data: 'Descricao'
                },
                {
                    data: 'Valor'
                },
                {
                    data: 'Data de Emissão'
                },
                {
                    data: 'Data de Baixa'
                },
                {
                    data: 'Data de Vencimento'
                },
                {
                    data: 'Fluxoconta'
                },
                {
                    data: 'Fornecedor'
                },
                {
                    data: 'Cliente'
                },

                {
                    data: 'Ações',
                    render: function(data, type, row) {
                        return type === 'export' ?
                            null :
                            data;
                    }
                }
            ],
            buttons: [{

              text: 'Adicionar',
              className: 'but',
              action: function(){
                  window.location.href = '/lancamentos/add'
              }

            },
            {
                    extend: 'copyHtml5',
                    text: 'Copiar',

                    exportOptions: {
                        orthogonal: 'export',
                        columns: function(column, data, node) {
                            if (column > 7) {
                                return false;
                            }
                            return true;
                        },
                    }
                }, "print", "csvHtml5",
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        orthogonal: 'export',
                        columns: function(column, data, node) {
                            if (column > 7) {
                                return false;
                            }
                            return true;
                        },
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        orthogonal: 'export',
                        columns: function(column, data, node) {
                            if (column > 7) {
                                return false;
                            }
                            return true;
                        },
                    }
                },
                {
              extend: 'collection',
              text: 'Mostrar Colunas',
              buttons: [ 'columnsVisibility' ],
              visibility: true
            },
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
