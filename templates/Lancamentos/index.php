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

<div class="container-fluid d-flex align-items-center justify-content-center p-5">
    <div class="card container card-outline bg-white" style="border: green solid 2px; border-radius: 20px;">
        <div class="card-header d-sm-flex" style="padding-top: 50px;">

            <div>
                <?= $this->Html->link(__('Previsto'), ['action' => '#'], ['class' => 'btn btn-info btn-sm', 'onclick' => 'previsto()']) ?>
            </div>
            <div style="margin-left: 25px;">
                <?= $this->Html->link(__('Realizado'), ['action' => '#'], ['class' => 'btn btn-info btn-sm', 'onclick' => 'realizado()']) ?>
            </div>

            <div class="card-toolbox">

                <?= $this->Paginator->limitControl([], null, [
                    'label' => false,
                    'class' => 'form-control-sm',
                    'style' => 'color: #029BE1; border: 2px solid green;',
                ]); ?>
                <?= $this->Html->link(__('Novo Lançamento'), ['action' => 'add'], ['class' => 'btn btn-info btn-sm']) ?>
                <?= $this->Html->link(__('Caixa Diário'), ['controller' => 'relatorios', 'action' => 'caixadiario'], ['class' => 'btn btn-info btn-sm']) ?>
            </div>
        </div>



        <div class="card-body table-responsive p-0">
            <div id='prev' style="display:none;">
                <table class="table text-nowrap">
                    <thead>
                        <tr style="color: green;">

                            <th class="teste"><?= ('Tipo') ?></th>
                            <th class="teste"><?= ('Descricao') ?></th>
                            <th class="teste"><?= ('Valor') ?></th>
                            <th class="teste"><?= ('Data de Emissão') ?></th>
                            <th class="teste"><?= ('Data de Baixa') ?></th>
                            <th class="teste"><?= ('Data de Vencimento') ?></th>

                            <th class="teste"><?= ('Fluxoconta') ?></th>
                            <th class="teste"><?= ('Fornecedor') ?></th>
                            <!-- <th class="teste"><?= ('Cliente') ?></th> -->
                            <!--
          <th class="teste"><?= ('Dreconta') ?></th> -->
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

                                    <td><?= $lancamento->has('fluxoconta') ? $this->Html->link($lancamento->fluxoconta->conta, ['controller' => 'Fluxocontas', 'action' => 'view', $lancamento->fluxoconta->conta]) : '' ?></td>
                                    <td><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->nome, ['controller' => 'Fornecedores', 'action' => 'view', $lancamento->fornecedore->nome]) : '' ?></td>
                                    <!-- <td><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->nome, ['controller' => 'Clientes', 'action' => 'view', $lancamento->cliente->nome]) : '' ?></td> -->
                                    <!-- <td><?= $lancamento->has('dreconta') ? $this->Html->link($lancamento->dreconta->conta, ['controller' => 'Drecontas', 'action' => 'view', $lancamento->dreconta->conta]) : '' ?></td> -->
                                    <td class="actions">
                                        <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_baixa == null)) { ?>
                                            <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-secondary']) ?>
                                        <?php } ?>
                                        <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-info', 'escape' => false]) ?>
                                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-success', 'escape' => false]) ?>
                                        <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $lancamento->tipo)]) ?>
                                    </td>

                                <?php } ?>

                            <?php endforeach; ?>
                    </tbody>

                </table>


                <!-- /.card-body -->

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
            <!-- /.card-footer -->
        </div>

        <div id='real' style="display:none;">
            <table class="table text-nowrap">
                <thead>
                    <tr style="color: green;">

                        <th class="teste"><?= ('Tipo') ?></th>
                        <th class="teste"><?= ('Descricao') ?></th>
                        <th class="teste"><?= ('Valor') ?></th>
                        <th class="teste"><?= ('Data de Emissão') ?></th>
                        <th class="teste"><?= ('Data de Baixa') ?></th>
                        <th class="teste"><?= ('Data de Vencimento') ?></th>

                        <th class="teste"><?= ('Fluxoconta') ?></th>
                        <th class="teste"><?= ('Fornecedor') ?></th>
                        <!-- <th class="teste"><?= ('Cliente') ?></th> -->
                        <!--
          <th class="teste"><?= ('Dreconta') ?></th> -->
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

                                <td><?= $lancamento->has('fluxoconta') ? $this->Html->link($lancamento->fluxoconta->conta, ['controller' => 'Fluxocontas', 'action' => 'view', $lancamento->fluxoconta->conta]) : '' ?></td>
                                <td><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->nome, ['controller' => 'Fornecedores', 'action' => 'view', $lancamento->fornecedore->nome]) : '' ?></td>
                                <!-- <td><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->nome, ['controller' => 'Clientes', 'action' => 'view', $lancamento->cliente->nome]) : '' ?></td> -->
                                <!-- <td><?= $lancamento->has('dreconta') ? $this->Html->link($lancamento->dreconta->conta, ['controller' => 'Drecontas', 'action' => 'view', $lancamento->dreconta->conta]) : '' ?></td> -->
                                <td class="actions">
                                    <?php if (($lancamento->tipo == "PREVISTO") && ($lancamento->data_baixa == null)) { ?>
                                        <!-- <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?> -->
                                        <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                                    <?php } ?>
                                    <!-- <?= $this->Html->link(__('Dar baixa'), ['controller' => 'Caixaregistros', 'action' => 'darbaixa', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-primary', 'escape' => false]) ?> -->
                                    <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-info', 'escape' => false]) ?>
                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-success', 'escape' => false]) ?>
                                    <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $lancamento->id_lancamento], ['class' => 'btn btn-xs btn-outline-danger', 'escape' => false, 'confirm' => __('Você quer mesmo deletar {0}?', $lancamento->tipo)]) ?>
                                </td>

                            <?php } ?>

                        <?php endforeach; ?>
                </tbody>
            </table>


            <!-- /.card-body -->

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
        <!-- /.card-footer -->
    </div>

</div>
</div>