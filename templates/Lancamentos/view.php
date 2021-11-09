<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>

<div class=" container">
  <div class="views container-fluid d-flex align-items-center justify-content-center">
    <div class="carVIEW card card-1 card-outline container bg-white ">

      <div class="carhVIEW card-header d-sm-flex">
        <h2 class="card-title"><?= h($lancamento->id_lancamento) ?></h2>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="theINDEX tboINDEX table table-hover text-nowrap">
          <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= h($lancamento->tipo) ?></td>
          </tr>
          <tr>
            <th><?= __('Descrição') ?></th>
            <td><?= h($lancamento->descricao) ?></td>
          </tr>
          <tr>
            <th> <?= __('Conta') ?></th>
            <td class="tdINDEX"><?= $lancamento->has('fluxoconta') ? $this->Html->link($lancamento->fluxoconta->conta, ['controller' => 'Fluxocontas', 'action' => 'view', $lancamento->fluxoconta->conta]) : '' ?></td>
          </tr>
          <tr>
            <th><?= __('Fornecedor') ?></th>
            <td class="tdINDEX"><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->fornecedor, ['controller' => 'Fornecedores', 'action' => 'view', $lancamento->fornecedore->fornecedor]) : '' ?></td>
          </tr>
          <tr>
            <th><?= __('Cliente') ?></th>
            <td class="tdINDEX"><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->cliente, ['controller' => 'Clientes', 'action' => 'view', $lancamento->cliente->cliente]) : '' ?></td>
          </tr>
          <!-- <tr>
            <th><?= __('Dreconta') ?></th>
            <td class="tdINDEX"><?= $lancamento->has('dreconta') ? $this->Html->link($lancamento->dreconta->dreconta, ['controller' => 'Drecontas', 'action' => 'view', $lancamento->dreconta->conta]) : '' ?></td>
          </tr> -->
          <tr>
            <th><?= __('Lançamento') ?></th>
            <td><?= $this->Number->format($lancamento->id_lancamento) ?></td>
          </tr>
          <tr>
            <th><?= __('Valor') ?></th>
            <td><?= $this->Number->format($lancamento->valor) ?></td>
          </tr>
          <tr>
            <th><?= __('Lançamento') ?></th>
            <td><?= $this->Number->format($lancamento->lancamento_id) ?></td>
          </tr>
          <tr>
            <th><?= __('Data de Emissão') ?></th>
            <td><?= h($lancamento->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
          </tr>
          <tr>
            <th><?= __('Data de Baixa') ?></th>
            <?php if (empty($lancamento->data_baixa)) { ?>
              <td><?= h($lancamento->data_baixa) ?></td>
            <?php } else { ?>
              <td><?= h($lancamento->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <?php } ?>
          </tr>
          <tr>
            <th><?= __('Data de Vencimento') ?></th>
            <td><?= h($lancamento->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
          </tr>
          <tr>
            <th><?= __('Criado') ?></th>
            <td><?= h($lancamento->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
          </tr>
          <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($lancamento->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
          </tr>
        </table>
      </div>
      <div class="carfVIEW card-footer bg-white">
        <div class="carfVIEW2 d-flex bd-highlight mb-3">
          <?= $this->Form->postLink(
            __('Deletar'),
            ['action' => 'delete',  $lancamento->id_lancamento],
            ['confirm' => __('Você quer mesmo deletar?',  $lancamento->id_lancamento), 'class' => 'del btn btn-sm btn-outline-danger mr-auto p-2 bd-highlight']
          ) ?>
          <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $lancamento->id_lancamento], ['class' => 'edi btn btn-sm btn-outline-success p-2 bd-highlight']) ?>
          <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'vis btn btn-sm btn-outline-info p-2 bd-highligh']) ?>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid d-flex align-items-center justify-content-center views">
    <div class="row card-2  card-outline container">
      <div class="col-12">
        <!-- Custom Tabs -->
        <div class="carVIEW2 card" >
          <div class="card-header d-flex p-0">
            <h3 class="carttVIEW card-title p-3" >Histórico do lançamento</h3>
            <ul class="nav nav-pills ml-auto p-2" id="tab_header">
              <li class="nav-item"><a class="btn vis btn-sm active" href="#inicio" data-toggle="tab">Começo</a></li>
              <?php foreach ($lancamento->lancamentos as $l) : ?>
                <li class="nav-item"><a class="btn btn-info btn-sm" href="#tab_<?= $l->id_lancamento ?>" data-toggle="tab"><?= $l->id_lancamento ?></a></li>
              <?php endforeach ?>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane text-info active" id="inicio">
                Clique nos numerais acima para ver os lançamentos anteriores a esse
              </div>
              <?php foreach ($lancamento->lancamentos as $l) : ?>
                <?= $this->element('lancamentos/card', ['lancamento' => $l]) ?>
              <?php endforeach ?>
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- ./card -->
      </div>
      <!-- /.col -->
    </div>
  </div>

  <div class="container-fluid d-flex align-items-center justify-content-center views">

    <div  class="relVIEW related card-3 related-caixaregistros view card container bg-white">

      <div class="relhVIEW card-header d-sm-flex">
        <h3 class="carttVIEW card-title"><?= __('Relacionados') ?></h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="theINDEX tboINDEX table table-hover text-nowrap">
          <tr>
            <th><?= __('Nº de Registro de Caixa') ?></th>
            <th><?= __('Caixa') ?></th>
            <th><?= __('Tipo de Pagamento') ?></th>
            <th><?= __('Lançamento') ?></th>
            <th class="actions"><?= __('Ações') ?></th>
          </tr>
          <?php if (empty($lancamento->caixaregistros)) { ?>
            <tr>
              <td colspan="5">
                Não Encontrado!
              </td>
            </tr>
          <?php } else { ?>
            <?php foreach ($lancamento->caixaregistros as $caixaregistros) : ?>
              <tr>
                <td><?= h($caixaregistros->id_caixaregistro) ?></td>
                <td><?= h($caixaregistros->caixa_id) ?></td>
                <td><?= h($caixaregistros->tipopagamento_id) ?></td>
                <td><?= h($caixaregistros->lancamento_id) ?></td>
                <td class="actions">
                  <?= $this->Html->link(__('Visualizar'), ['controller' => 'Caixaregistros', 'action' => 'view', $caixaregistros->id_caixaregistro], ['class' => 'btn vis btn-xs btn-outline-info']) ?>
                  <?= $this->Html->link(__('Editar'), ['controller' => 'Caixaregistros', 'action' => 'edit', $caixaregistros->id_caixaregistro], ['class' => 'btn edi btn-xs btn-outline-success']) ?>
                  <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Caixaregistros', 'action' => 'delete', $caixaregistros->id_caixaregistro], ['class' => 'btn del btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $caixaregistros->id_caixaregistro)]) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>

  <div class="container-fluid d-flex align-items-center justify-content-center views">

    <div class="relVIEW related card-4 related-caixaregistros view card container bg-white">

      <div class="relhVIEW card-header d-sm-flex">
        <h3 class="carttVIEW card-title"><?= __('Relacionados') ?></h3>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table theINDEX tboINDEX table-hover text-nowrap">
          <tr>
            <th><?= __('Nº de Comprovante') ?></th>
            <th><?= __('Nome de Arquivo') ?></th>
            <th><?= __('Tipo') ?></th>
            <th><?= __('Lançamento') ?></th>
            <th><?= __('Criado') ?></th>
            <th><?= __('Modificado') ?></th>
            <th class="actions"><?= __('Ações') ?></th>
          </tr>
          <?php if (empty($lancamento->comprovantes)) { ?>
            <tr>
              <td colspan="7">
                Não Encontrado!
              </td>
            </tr>
          <?php } else { ?>
            <?php foreach ($lancamento->comprovantes as $comprovantes) : ?>
              <tr>
                <td><?= h($comprovantes->id_comprovante) ?></td>
                <td><?= h($comprovantes->nome_arquivo) ?></td>
                <td><?= h($comprovantes->tipo) ?></td>
                <td><?= h($comprovantes->lancamento_id) ?></td>
                <td><?= h($comprovantes->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                <td><?= h($comprovantes->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
                <td class="actions">
                  <?= $this->Html->link(__('Visualizar'), ['controller' => 'Comprovantes', 'action' => 'view', $comprovantes->id_comprovante], ['class' => 'btn vis btn-xs btn-outline-info']) ?>
                  <?= $this->Html->link(__('Editar'), ['controller' => 'Comprovantes', 'action' => 'edit', $comprovantes->id_comprovante], ['class' => 'btn edi btn-xs btn-outline-success']) ?>
                  <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Comprovantes', 'action' => 'delete', $comprovantes->id_comprovante], ['class' => 'btn del btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $comprovantes->nome_arquivo)]) ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php } ?>
        </table>
      </div>
    </div>
  </div>

</div>
