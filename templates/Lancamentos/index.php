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
</style>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Todos os lançamentos</h3>
    </div>
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead class="nm">
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
            </thead>
            <tbody>
                <?php foreach ($lancamentos as $lancamento) : ?>
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

                            <td><?= $lancamento->has('fluxoconta') ? $this->Html->link($lancamento->fluxoconta->conta, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->fluxoconta->conta]) : '' ?></td>
                            <td><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->nome, ['controller' => 'Lancamentos', 'action' => 'index', $lancamento->fornecedore->nome]) : '' ?></td>
                            <td class="actions">
                                <div class="btn-group">
                                    <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-info ', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-success ', 'escape' => false]) ?>
                                    <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-danger ', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $lancamento->tipo)]) ?>
                                    <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_baixa == null)) { ?>
                                        <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-dark ']) ?>
                                    <?php } ?>
                                    <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_vencimento->i18nFormat('yyyy-MM-dd', 'UTC') < $now) && ($lancamento->data_baixa == null)) { ?>
                                        <?= $this->Html->link(__('Renovar'), ['controller' => 'Lancamentos', 'action' => 'renovar', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-secondary ']) ?>
                                    <?php } ?>
                                </div>

                            </td>


                    <?php endforeach; ?>
            </tbody>
            <tfoot>
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
            </tfoot>
        </table>
    </div>
</div>

<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
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
                }
            ]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
