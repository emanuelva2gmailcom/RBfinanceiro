<div class="tab-pane" id="tab_<?= $lancamento->id_lancamento ?>">

        <div class="card-header d-sm-flex" style="padding-top: 50px; color: green;">
            <h2 class="card-title"><?= h($lancamento->id_lancamento) ?></h2>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <tr>
                    <th style="color: green;"><?= __('Tipo') ?></th>
                    <td class="text-info"><?= h($lancamento->tipo) ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Descricao') ?></th>
                    <td class="text-info"><?= h($lancamento->descricao) ?></td>
                </tr>
                <tr>
                    <th style="color: green;"> <?= __('Fluxoconta') ?></th>
                    <td class="tr1"><?= $lancamento->has('fluxoconta') ? $this->Html->link($lancamento->fluxoconta->conta, ['controller' => 'Fluxocontas', 'action' => 'view', $lancamento->fluxoconta->conta]) : '' ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Fornecedor') ?></th>
                    <td class="tr1"><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->fornecedor, ['controller' => 'Fornecedores', 'action' => 'view', $lancamento->fornecedore->fornecedor]) : '' ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Cliente') ?></th>
                    <td class="tr1"><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->cliente, ['controller' => 'Clientes', 'action' => 'view', $lancamento->cliente->cliente]) : '' ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Dreconta') ?></th>
                    <td class="tr1"><?= $lancamento->has('dreconta') ? $this->Html->link($lancamento->dreconta->dreconta, ['controller' => 'Drecontas', 'action' => 'view', $lancamento->dreconta->conta]) : '' ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Id Lancamento') ?></th>
                    <td class="text-info"><?= $this->Number->format($lancamento->id_lancamento) ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Valor') ?></th>
                    <td class="text-info"><?= $this->Number->format($lancamento->valor) ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Lancamento Id') ?></th>
                    <td class="text-info"><?= $this->Number->format($lancamento->lancamento_id) ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Data Emissao') ?></th>
                    <td class="text-info"><?= h($lancamento->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Data Baixa') ?></th>
                    <?php if (empty($lancamento->data_baixa)) { ?>
                        <td class="text-info"><?= h($lancamento->data_baixa) ?></td>
                    <?php } else { ?>
                        <td class="text-info"><?= h($lancamento->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                    <?php } ?>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Data Vencimento') ?></th>
                    <td class="text-info"><?= h($lancamento->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Created') ?></th>
                    <td class="text-info"><?= h($lancamento->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                </tr>
                <tr>
                    <th style="color: green;"><?= __('Modified') ?></th>
                    <td class="text-info"><?= h($lancamento->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                </tr>
            </table>
        </div>
        <div class="card-footer bg-white" style="border-radius: 20px;">
            <div style="padding-top: 20px;" class="d-flex justify-content-end">
                <?= $this->Form->postLink(
                    __('Deletar'),
                    ['action' => 'delete',  $lancamento->id_lancamento],
                    ['confirm' => __('Você quer mesmo deletar?',  $lancamento->id_lancamento), 'class' => 'del btn btn-sm btn-outline-danger']
                ) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $lancamento->id_lancamento], ['class' => 'edi btn btn-sm btn-outline-success']) ?>
                <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-sm btn-outline-info']) ?>
            </div>
        </div>
</div>