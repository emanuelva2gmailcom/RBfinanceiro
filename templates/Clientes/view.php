<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente $cliente
 */
?>

<?php
$this->assign('title', __('Cliente') );
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($cliente->nome) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($cliente->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Cpf') ?></th>
            <td><?= h($cliente->cpf) ?></td>
        </tr>
        <tr>
            <th><?= __('Endereco') ?></th>
            <td><?= h($cliente->endereco) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($cliente->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Telefone') ?></th>
            <td><?= h($cliente->telefone) ?></td>
        </tr>
        <tr>
            <th><?= __('Id Cliente') ?></th>
            <td><?= $this->Number->format($cliente->id_cliente) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($cliente->created->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($cliente->modified->i18nFormat('dd-MM-yyyy', 'UTC')) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Pendente') ?></th>
            <td><?= $cliente->is_pendente ? __('Sim') : __('Não'); ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $cliente->id_cliente],

          ['confirm' => __('você quer mesmo deletar o cliente {0}?',  $cliente->nome), 'class' => 'btn btn-danger']


      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $cliente->id_cliente], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


<div class="related related-lancamentos view card">
  <div class="card-header d-sm-flex">
    <h3 class="card-title"><?= __('Relacionados') ?></h3>
    <div class="card-toolbox">
      <?= $this->Html->link(__('Novo'), ['controller' => 'Lancamentos' , 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
      <?= $this->Html->link(__('Todos'), ['controller' => 'Lancamentos' , 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
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
      <?php if (empty($cliente->lancamentos)) { ?>
        <tr>
            <td colspan="15" class="text-muted">
              Não encontrado!
            </td>
        </tr>
      <?php }else{ ?>
        <?php foreach ($cliente->lancamentos as $lancamentos) : ?>
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
              <?= $this->Form->postLink(__('Deletar'), ['controller' => 'Lancamentos', 'action' => 'delete', $lancamentos->id_lancamento], ['class'=>'btn btn-xs btn-outline-danger', 'confirm' => __('Você quer mesmo deletar?', $lancamentos->id_lancamento)]) ?>
            </td>
        </tr>
        <?php endforeach; ?>
      <?php } ?>
    </table>
  </div>
</div>

