<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>

<style>


  .tr1 a {
    color: #029BE1;
  }

  .tr1 a {
    color: #029BE1;
  }
</style>


<div class="container-fluid d-flex align-items-center justify-content-center p-5">

  <div style="border: green solid 2px; border-radius: 20px;" class="card card-outline container bg-white ">

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
          <th style="color: green;"><?= __('Descrição') ?></th>
          <td class="text-info"><?= h($lancamento->descricao) ?></td>
        </tr>
        <tr>
          <th style="color: green;"> <?= __('Conta') ?></th>
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
        <!-- <tr>
          <th style="color: green;"><?= __('Dreconta') ?></th>
          <td class="tr1"><?= $lancamento->has('dreconta') ? $this->Html->link($lancamento->dreconta->dreconta, ['controller' => 'Drecontas', 'action' => 'view', $lancamento->dreconta->conta]) : '' ?></td>
        </tr> -->
        <tr>
          <th style="color: green;"><?= __('N° de Lançamento') ?></th>
          <td class="text-info"><?= $this->Number->format($lancamento->id_lancamento) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Valor') ?></th>
          <td class="text-info"><?= $this->Number->format($lancamento->valor) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Lançamento') ?></th>
          <td class="text-info"><?= $this->Number->format($lancamento->lancamento_id) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Data de Emissão') ?></th>
          <td class="text-info"><?= h($lancamento->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Data de Baixa') ?></th>
          <?php if (empty($lancamento->data_baixa)) { ?>
            <td class="text-info"><?= h($lancamento->data_baixa) ?></td>
          <?php } else { ?>
            <td class="text-info"><?= h($lancamento->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
          <?php } ?>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Data de Vencimento') ?></th>
          <td class="text-info"><?= h($lancamento->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Criado') ?></th>
          <td class="text-info"><?= h($lancamento->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
          <th style="color: green;"><?= __('Modificado') ?></th>
          <td class="text-info"><?= h($lancamento->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
      </table>
    </div>
    <div class="card-footer bg-white" style="border-radius: 20px;">
      <div style="padding-top: 20px;" class="d-flex mr-auto justify-content-around">

        <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $lancamento->id_lancamento],
          ['confirm' => __('Você quer mesmo deletar?',  $lancamento->id_lancamento), 'class' => 'btn btn-sm btn-outline-danger']
        ) ?>

          <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $lancamento->id_lancamento], ['class' => ' btn btn-sm btn-outline-success']) ?>
          <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-sm btn-outline-info']) ?>

      </div>
    </div>
  </div>
</div>

<div class="testee container-fluid d-flex align-items-center justify-content-center p-5">
  <div class=" row">
    <div class="col-12">
      <!-- Custom Tabs -->
      <div class="card" style="border: green solid 2px; border-radius: 20px;" class="related related-caixaregistros view card container bg-white">
        <div class="card-header d-flex p-0">
          <h3 class="card-title p-3" style="color: green;">Histórico do lançamento</h3>
          <ul class="nav nav-pills ml-auto p-2" id="tab_header">
            <li class="nav-item"><a class="btn btn-info btn-sm active" href="#inicio" data-toggle="tab">Começo</a></li>
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

<div class="container-fluid d-flex align-items-center justify-content-center p-5">

  <div style="border: green solid 2px; border-radius: 20px;" class="related related-caixaregistros view card container bg-white">

    <div class="card-header d-sm-flex" style="padding-top: 50px;">
      <h3 class="card-title" style="color: green;"><?= __('Relacionados') ?></h3>
      <!-- <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Caixaregistros', 'action' => 'add'], ['class' => 'btn btn-info btn-sm']) ?>
      <?= $this->Html->link(__('Todos '), ['controller' => 'Caixaregistros', 'action' => 'index'], ['class' => 'btn btn-info btn-sm']) ?>
    </div> -->
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <tr style="color: green;">
          <th><?= __('N° de Caixa Registro') ?></th>
          <th><?= __('Caixa') ?></th>
          <th><?= __('Tipo de Pagamento') ?></th>
          <th><?= __('Lançamento') ?></th>
          <th class="actions"><?= __('Ações') ?></th>
        </tr>
        <?php if (empty($lancamento->caixaregistros)) { ?>
          <tr>
            <td colspan="5" class="text-info">
              Não Encontrado!
            </td>
          </tr>
        <?php } else { ?>
          <?php foreach ($lancamento->caixaregistros as $caixaregistros) : ?>
            <tr>
              <td class="text-info"><?= h($caixaregistros->id_caixaregistro) ?></td>
              <td class="text-info"><?= h($caixaregistros->caixa_id) ?></td>
              <td class="text-info"><?= h($caixaregistros->tipopagamento_id) ?></td>
              <td class="text-info"><?= h($caixaregistros->lancamento_id) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Visualizar'), ['controller' => 'Caixaregistros', 'action' => 'view', $caixaregistros->id_caixaregistro], ['class' => 'btn btn-xs btn-outline-info']) ?>
                <?= $this->Html->link(__('Editar'), ['controller' => 'Caixaregistros', 'action' => 'edit', $caixaregistros->id_caixaregistro], ['class' => 'btn btn-xs btn-outline-success']) ?>
                <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Caixaregistros', 'action' => 'delete', $caixaregistros->id_caixaregistro], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $caixaregistros->id_caixaregistro)]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php } ?>
      </table>
    </div>
  </div>
</div>

<div class="container-fluid d-flex align-items-center justify-content-center p-5">

  <div style="border: green solid 2px; border-radius: 20px;" class="related related-caixaregistros view card container bg-white">

    <div class="card-header d-sm-flex" style="padding-top: 50px;">
      <h3 class="card-title" style="color: green;"><?= __('Relacionados') ?></h3>
      <!-- <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Comprovantes', 'action' => 'add'], ['class' => 'btn btn-info btn-sm']) ?>
      <?= $this->Html->link(__('Todos '), ['controller' => 'Comprovantes', 'action' => 'index'], ['class' => 'btn btn-info btn-sm']) ?>
    </div> -->
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <tr style="color: green;">
          <th><?= __('N° de Comprovante') ?></th>
          <th><?= __('Nome do Arquivo') ?></th>
          <th><?= __('Tipo') ?></th>
          <th><?= __('Lançamento') ?></th>
          <th><?= __('Criado') ?></th>
          <th><?= __('Modificado') ?></th>
          <th class="actions"><?= __('Ações') ?></th>
        </tr>
        <?php if (empty($lancamento->comprovantes)) { ?>
          <tr>
            <td colspan="7" class="text-info">
              Não Encontrado!
            </td>
          </tr>
        <?php } else { ?>
          <?php foreach ($lancamento->comprovantes as $comprovantes) : ?>
            <tr>
              <td class="text-info"><?= h($comprovantes->id_comprovante) ?></td>
              <td class="text-info"><?= h($comprovantes->nome_arquivo) ?></td>
              <td class="text-info"><?= h($comprovantes->tipo) ?></td>
              <td class="text-info"><?= h($comprovantes->lancamento_id) ?></td>
              <td class="text-info"><?= h($comprovantes->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td class="text-info"><?= h($comprovantes->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
              <td class="actions">
                <?= $this->Html->link(__('Visualizar'), ['controller' => 'Comprovantes', 'action' => 'view', $comprovantes->id_comprovante], ['class' => 'btn btn-xs btn-outline-info']) ?>
                <?= $this->Html->link(__('Editar'), ['controller' => 'Comprovantes', 'action' => 'edit', $comprovantes->id_comprovante], ['class' => 'btn btn-xs btn-outline-success']) ?>
                <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Comprovantes', 'action' => 'delete', $comprovantes->id_comprovante], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $comprovantes->nome_arquivo)]) ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php } ?>
      </table>
    </div>
  </div>
</div>
