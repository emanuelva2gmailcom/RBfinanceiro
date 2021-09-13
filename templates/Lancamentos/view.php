<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lancamento $lancamento
 */
?>




<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($lancamento->id_lancamento) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= h($lancamento->tipo) ?></td>
        </tr>
        <tr>
            <th><?= __('Descricao') ?></th>
            <td><?= h($lancamento->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Fluxoconta') ?></th>
            <td><?= $lancamento->has('fluxoconta') ? $this->Html->link($lancamento->fluxoconta->conta, ['controller' => 'Fluxocontas', 'action' => 'view', $lancamento->fluxoconta->conta]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Fornecedor') ?></th>
            <td><?= $lancamento->has('fornecedore') ? $this->Html->link($lancamento->fornecedore->fornecedor, ['controller' => 'Fornecedores', 'action' => 'view', $lancamento->fornecedore->fornecedor]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Cliente') ?></th>
            <td><?= $lancamento->has('cliente') ? $this->Html->link($lancamento->cliente->cliente, ['controller' => 'Clientes', 'action' => 'view', $lancamento->cliente->cliente]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Dreconta') ?></th>
            <td><?= $lancamento->has('dreconta') ? $this->Html->link($lancamento->dreconta->dreconta, ['controller' => 'Drecontas', 'action' => 'view', $lancamento->dreconta->conta]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id Lancamento') ?></th>
            <td><?= $this->Number->format($lancamento->id_lancamento) ?></td>
        </tr>
        <tr>
            <th><?= __('Valor') ?></th>
            <td><?= $this->Number->format($lancamento->valor) ?></td>
        </tr>
        <tr>
            <th><?= __('Lancamento Id') ?></th>
            <td><?= $this->Number->format($lancamento->lancamento_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Emissao') ?></th>
            <td><?= h($lancamento->data_emissao) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Baixa') ?></th>
            <td><?= h($lancamento->data_baixa) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Vencimento') ?></th>
            <td><?= h($lancamento->data_vencimento) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($lancamento->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($lancamento->modified) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $lancamento->id_lancamento],
          ['confirm' => __('Are you sure you want to delete # {0}?',  $lancamento->id_lancamento), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $lancamento->id_lancamento], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-lancamentos view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Lancamentos') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('Novos'), ['controller' => 'Lancamentos' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('Todos '), ['controller' => 'Lancamentos' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
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
            <td colspan="15" class="text-muted">
              Não Encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($lancamento->lancamentos as $lancamentos) : ?>
        <tr>
            <td><?= h($lancamentos->id_lancamento) ?></td>
            <td><?= h($lancamentos->tipo) ?></td>
            <td><?= h($lancamentos->descricao) ?></td>
            <td><?= h($lancamentos->valor) ?></td>
            <td><?= h($lancamentos->data_emissao) ?></td>
            <td><?= h($lancamentos->data_baixa) ?></td>
            <td><?= h($lancamentos->data_vencimento) ?></td>
            <td><?= h($lancamentos->created) ?></td>
            <td><?= h($lancamentos->modified) ?></td>
            <td><?= h($lancamentos->fluxoconta_id) ?></td>
            <td><?= h($lancamentos->fornecedor_id) ?></td>
            <td><?= h($lancamentos->cliente_id) ?></td>
            <td><?= h($lancamentos->lancamento_id) ?></td>
            <td><?= h($lancamentos->dreconta_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['controller' => 'Lancamentos', 'action' => 'view', $lancamentos->id_lancamento], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Editar'), ['controller' => 'Lancamentos', 'action' => 'edit', $lancamentos->id_lancamento], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Lancamentos', 'action' => 'delete', $lancamentos->id_lancamento], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $lancamentos->id_lancamento)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>

<div class="related related-caixaregistros view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Caixaregistros') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Caixaregistros' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('Todos '), ['controller' => 'Caixaregistros' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
          <th><?= __('Id Caixaregistro') ?></th>
          <th><?= __('Caixa Id') ?></th>
          <th><?= __('Tipopagamento Id') ?></th>
          <th><?= __('Lancamento Id') ?></th>
          <th class="actions"><?= __('Ações') ?></th>
      </tr>
      <?php if (empty($lancamento->caixaregistros)) { ?>
        <tr>
            <td colspan="5" class="text-muted">
            Não Encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($lancamento->caixaregistros as $caixaregistros) : ?>
        <tr>
            <td><?= h($caixaregistros->id_caixaregistro) ?></td>
            <td><?= h($caixaregistros->caixa_id) ?></td>
            <td><?= h($caixaregistros->tipopagamento_id) ?></td>
            <td><?= h($caixaregistros->lancamento_id) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['controller' => 'Caixaregistros', 'action' => 'view', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Editar'), ['controller' => 'Caixaregistros', 'action' => 'edit', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Caixaregistros', 'action' => 'delete', $caixaregistros->id_caixaregistro], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $caixaregistros->id_caixaregistro)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>

<div class="related related-comprovantes view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Related Comprovantes') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Comprovantes' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('Todos '), ['controller' => 'Comprovantes' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
      <tr>
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
            <td colspan="7" class="text-muted">
            Não Encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($lancamento->comprovantes as $comprovantes) : ?>
        <tr>
            <td><?= h($comprovantes->id_comprovante) ?></td>
            <td><?= h($comprovantes->nome_arquivo) ?></td>
            <td><?= h($comprovantes->tipo) ?></td>
            <td><?= h($comprovantes->lancamento_id) ?></td>
            <td><?= h($comprovantes->created) ?></td>
            <td><?= h($comprovantes->modified) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['controller' => 'Comprovantes', 'action' => 'view', $comprovantes->id_comprovante], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Html->link(__('Editar'), ['controller' => 'Comprovantes', 'action' => 'edit', $comprovantes->id_comprovante], ['class'=>'btn btn-xs btn-outline-primary']) ?>
              <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Comprovantes', 'action' => 'delete', $comprovantes->id_comprovante], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $comprovantes->id_comprovante)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>

