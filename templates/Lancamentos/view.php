<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>

<style>

    .del{
        margin-right: 80%;
    }

    .edi{
        margin-right: 3%;
    }

    .tr1 a{
        color: #029BE1;
    }

</style>


<div  class="container-fluid d-flex align-items-center justify-content-center p-5">

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
</div>


<div  class="container-fluid d-flex align-items-center justify-content-center p-5">

<div style="border: green solid 2px; border-radius: 20px;"  class="related related-caixaregistros view card container bg-white">

  <div class="card-header d-sm-flex" style="padding-top: 50px;">
    <h3 class="card-title" style="color: green;"><?= __('Relacionados') ?></h3>
    <!-- <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Lancamentos', 'action' => 'add'], ['class' => 'btn btn-info btn-sm']) ?>
      <?= $this->Html->link(__('Todos '), ['controller' => 'Lancamentos', 'action' => 'index'], ['class' => 'btn btn-info btn-sm']) ?>
    </div> -->
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr style="color: green;">
        <th><?= __('Id Lancamento') ?></th>
        <th><?= __('Tipo') ?></th>
        <th><?= __('Descricao') ?></th>
        <th><?= __('Valor') ?></th>
        <th><?= __('Data Emissao') ?></th>
        <th><?= __('Data Baixa') ?></th>
        <th><?= __('Data Vencimento') ?></th>
        <th><?= __('Created') ?></th>
        <th><?= __('Modified') ?></th>
        <th><?= __('Fluxoconta Id') ?></th>
        <th><?= __('Fornecedor Id') ?></th>
        <th><?= __('Cliente Id') ?></th>
        <th><?= __('Lancamento Id') ?></th>
        <th><?= __('Dreconta Id') ?></th>
        <th class="actions"><?= __('Ações') ?></th>
      </tr>
      <?php if (empty($lancamento->lancamentos)) { ?>
        <tr>
          <td colspan="15" class="text-info">
            Não Encontrado!
          </td>
        </tr>
      <?php } else { ?>
        <?php foreach ($lancamento->lancamentos as $lancamentos) : ?>
          <tr>
            <td class="text-info"><?= h($lancamentos->id_lancamento) ?></td>
            <td class="text-info"><?= h($lancamentos->tipo) ?></td>
            <td class="text-info"><?= h($lancamentos->descricao) ?></td>
            <td class="text-info"><?= h($lancamentos->valor) ?></td>
            <td class="text-info"><?= h($lancamentos->data_emissao->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <?php if (empty($lancamento->data_baixa)) { ?>
          <td class="text-info"><?= h($lancamento->data_baixa) ?></td>
        <?php } else { ?>
          <td class="text-info"><?= h($lancamento->data_baixa->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        <?php } ?>
            <td class="text-info"><?= h($lancamentos->data_vencimento->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td class="text-info"><?= h($lancamentos->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td class="text-info"><?= h($lancamentos->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
            <td class="text-info"><?= h($lancamentos->fluxoconta_id) ?></td>
            <td class="text-info"><?= h($lancamentos->fornecedor_id) ?></td>
            <td class="text-info"><?= h($lancamentos->cliente_id) ?></td>
            <td class="text-info"><?= h($lancamentos->lancamento_id) ?></td>
            <td class="text-info"><?= h($lancamentos->dreconta_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['controller' => 'Lancamentos', 'action' => 'view', $lancamentos->id_lancamento], ['class' => 'btn btn-xs btn-outline-info']) ?>
              <?= $this->Html->link(__('Editar'), ['controller' => 'Lancamentos', 'action' => 'edit', $lancamentos->id_lancamento], ['class' => 'btn btn-xs btn-outline-success']) ?>
              <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Lancamentos', 'action' => 'delete', $lancamentos->id_lancamento], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar {0}?', $lancamentos->id_lancamento)]) ?>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>
</div>

<div  class="container-fluid d-flex align-items-center justify-content-center p-5">

<div style="border: green solid 2px; border-radius: 20px;"  class="related related-caixaregistros view card container bg-white">

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
        <th><?= __('Id Caixaregistro') ?></th>
        <th><?= __('Caixa Id') ?></th>
        <th><?= __('Tipopagamento Id') ?></th>
        <th><?= __('Lancamento Id') ?></th>
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

<div  class="container-fluid d-flex align-items-center justify-content-center p-5">

<div style="border: green solid 2px; border-radius: 20px;"  class="related related-caixaregistros view card container bg-white">

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
        <th><?= __('Id Comprovante') ?></th>
        <th><?= __('Nome Arquivo') ?></th>
        <th><?= __('Tipo') ?></th>
        <th><?= __('Lancamento Id') ?></th>
        <th><?= __('Created') ?></th>
        <th><?= __('Modified') ?></th>
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
