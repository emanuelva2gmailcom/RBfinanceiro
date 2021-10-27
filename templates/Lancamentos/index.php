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
        color: #029BE1;
    }

    .nm a {
        color: green;
    }

    .dataTables_info{
        color: green;
    }

    .dataTables_empty{
        color: #17a2b8;
    }

    .dataTables_filter input:focus {
      color: #17a2b8;
      border: green solid 2px;

    }
    .dataTables_filter input{
      color: #17a2b8;
      border: green solid 2px;

    }

    .dataTables_filter label{
      color: #17a2b8;

    }

    .buttons-copy {
        background-color: #17a2b8;
        color: white;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-copy:hover {
        background-color: white;
        color: #17a2b8;
        border: 1px solid #17a2b8;
        opacity: 0.7;
    }

    .buttons-print {
        background-color: #0099CC;
        color: white;
        border: 1px solid #0099CC;
        opacity: 0.7;
    }

    .buttons-print:hover {
        background-color: white;
        color: #0099CC;
        border: 1px solid #0099CC;
        opacity: 0.7;
    }

    .buttons-csv {
        background-color: green;
        color: white;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-csv:hover {
        background-color: white;
        color: green;
        border: 1px solid green;
        opacity: 0.7;
    }

    .buttons-excel {
        background-color: #006400;
        color: white;
        border: 1px solid #006400;
        opacity: 0.7;
    }

    .buttons-excel:hover {
        background-color: white;
        color: #006400;
        border: 1px solid #006400;
        opacity: 0.7;
    }

    .buttons-pdf {
        background-color: #4b4b4b;
        color: white;
        border: 1px solid #4b4b4b;
        opacity: 0.7;
    }

    .buttons-pdf:hover {
        background-color: white;
        color: #4b4b4b;
        border: 1px solid #4b4b4b;
        opacity: 0.7;
    }

    .buttons-collection {
        background-color: black;
        color: white;
        border: 1px solid black;
        opacity: 0.7;
    }

    .buttons-collection:hover {
        background-color: white;
        color: black;
        border: 1px solid black;
        opacity: 0.7;
    }

    li{
        color: #17a2b8;
    }

    li a{
        color: #17a2b8;
    }


</style>

<div class="card">

    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead class="nm">
                <tr style="color: green;">

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
                        <tr style="color: #029BE1;">
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
                                    <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-info ', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-success ', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('Deletar'), ['action' => 'delete', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-danger ', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $lancamento->tipo)]) ?>
                                </div>

                            </td>


                    <?php endforeach; ?>
            </tbody>
            <!-- <tfoot>
                <tr style="color: green;">

                    <th><?= __('Tipo') ?></th>
                    <th><?= __('Descricao') ?></th>
                    <th><?= __('Valor') ?></th>
                    <th><?= __('Data de Emissão') ?></th>
                    <th><?= __('Data de Baixa') ?></th>
                    <th><?= __('Data de Vencimento') ?></th>

                    <th><?= __('Fluxoconta') ?></th>
                    <th><?= __('Fornecedor') ?></th>
                    <th><?= __('Ações') ?></th>
                </tr>
            </tfoot> -->
        </table>

    </div>
</div>

<!-- <div class="container-fluid d-flex align-items-center justify-content-center p-5">
    <div class="card container card-outline bg-white" style="border: green solid 2px; border-radius: 20px;">
        <div class="card-header d-sm-flex" style="padding-top: 50px;">

            <div>
                <?= $this->Form->button(__('Previsto'), ['class' => 'btn btn-info btn-sm', 'onclick' => 'previsto()']) ?>


            </div>
            <div style="margin-left: 25px;">
                <?= $this->Form->button(__('Realizado'), ['class' => 'btn btn-info btn-sm', 'onclick' => 'realizado()']) ?>
            </div>

            <div class="card-toolbox">

                <?= $this->Paginator->limitControl([], null, [
                    'label' => false,
                    'class' => 'form-control-sm',
                    'style' => 'color: #029BE1; border: 2px solid green;',
                ]); ?>
            </div>
        </div>



        <div class="card-body table-responsive p-0">
            <div id='prev' style="display:none;">
                <table class="table text-nowrap">
                    <thead class="nm">
                        <tr style="color: green;">

                            <th class="teste"><?= $this->Paginator->sort('Tipo') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Descricao') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Valor') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Data de Emissão') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Data de Baixa') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Data de Vencimento') ?></th>

                            <th class="teste"><?= $this->Paginator->sort('Fluxoconta') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Fornecedor') ?></th>
                            <th class="actions teste"><?= __('Ações') ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($lancamentos as $lancamento) : ?>
                            <?php if ($lancamento->tipo == 'PREVISTO') { ?>
                                <tr style="color: #029BE1;">
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
                                    <!-- <td class="tr1"><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->nome, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->cliente->nome]) : '' ?></td>
                                    <!-- <td class="tr1"><?= $lancamento->has('dreconta') ? $this->Html->link($lancamento->dreconta->conta, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->dreconta->conta]) : '' ?></td>
                                    <td class="actions">
                                        <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_baixa == null)) { ?>
                                            <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-dark']) ?>
                                        <?php } ?>
                                        <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_vencimento->i18nFormat('yyyy-MM-dd', 'UTC') < $now) && ($lancamento->data_baixa == null)) { ?>
                                            <?= $this->Html->link(__('Renovar'), ['controller' => 'Lancamentos', 'action' => 'renovar', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-secondary']) ?>
                                        <?php } ?>
                                        <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-info', 'escape' => false]) ?>
                                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-success', 'escape' => false]) ?>
                                        <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $lancamento->tipo)]) ?>
                                    </td>

                                <?php } ?>

                            <?php endforeach; ?>
                    </tbody>

                </table>




                <div class="card-footer d-md-flex paginator" style="color: green;">
                    <div class="mr-auto" style="font-size:.8rem">
                        <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} lançamentos de {{count}} no total')) ?>
                    </div>

                    <ul class="pagination pagination-sm">
                        <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
                        <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
                        <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
                    </ul>


                </div>
            </div>

            <div id='real' style="display:none;">
                <table class="table text-nowrap">
                    <thead class="nm">
                        <tr style="color: green;">

                            <th class="teste"><?= $this->Paginator->sort('Tipo') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Descricao') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Valor') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Data de Emissão') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Data de Baixa') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Data de Vencimento') ?></th>

                            <th class="teste"><?= $this->Paginator->sort('Fluxoconta') ?></th>
                            <th class="teste"><?= $this->Paginator->sort('Fornecedor') ?></th>
                            <th class="actions teste"><?= __('Ações') ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($lancamentos as $lancamento) : ?>
                            <?php if ($lancamento->tipo == 'REALIZADO') { ?>
                                <tr style="color: #029BE1;">

                                    <td><?= h($lancamento->tipo) ?></td>
                                    <td><?= h($lancamento->descricao) ?></td>
                                    <td><?= $this->Number->format($lancamento->valor) ?></td>
                                    <td><?= h($lancamento->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                                    <td><?= h($lancamento->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                                    <td><?= h($lancamento->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>

                                    <td class="tr1"><?= $lancamento->has('fluxoconta') ? $this->Html->link($lancamento->fluxoconta->conta, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->fluxoconta->conta]) : '' ?></td>
                                    <td class="tr1"><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->nome, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->fornecedore->nome]) : '' ?></td>
                                    <!-- <td class="tr1"><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->nome, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->cliente->nome]) : '' ?></td>
                                    <!-- <td class="tr1"><?= $lancamento->has('dreconta') ? $this->Html->link($lancamento->dreconta->conta, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->dreconta->conta]) : '' ?></td>
                                    <td class="actions">
                                        <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_baixa == null)) { ?>
                                            <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                                        <?php } ?>
                                        <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-info', 'escape' => false]) ?>
                                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-success', 'escape' => false]) ?>
                                        <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $lancamento->tipo)]) ?>
                                    </td>

                                <?php } ?>

                            <?php endforeach; ?>
                    </tbody>
                </table>




                <div class="card-footer d-md-flex paginator" style="color: green;">
                    <div class="mr-auto" style="font-size:.8rem">
                        <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} lançamentos de {{count}} no total')) ?>
                    </div>

                    <ul class="pagination pagination-sm">
                        <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
                        <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
                        <?= $this->Paginator->numbers() ?>
                        <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
                        <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
                    </ul>

                </div>
            </div>
        </div>


    </div>

</div>
</div>-->
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
                    "previous":   "Depois"
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
