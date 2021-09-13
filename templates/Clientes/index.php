<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente[]|\Cake\Collection\CollectionInterface $clientes
 */
?>

<?php $this->assign('title', __('Clientes') ); ?>

<div class="card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><!-- --></h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
          ]); ?>
      <?= $this->Html->link(__('Novo Cliente'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
              <th><?= $this->Paginator->sort('id_cliente') ?></th>
              <th><?= $this->Paginator->sort('nome') ?></th>
              <th><?= $this->Paginator->sort('cpf') ?></th>
              <th><?= $this->Paginator->sort('endereco') ?></th>
              <th><?= $this->Paginator->sort('email') ?></th>
              <th><?= $this->Paginator->sort('telefone') ?></th>
              <th><?= $this->Paginator->sort('created') ?></th>
              <th><?= $this->Paginator->sort('modified') ?></th>
              <th><?= $this->Paginator->sort('is_pendente') ?></th>
              <th class="actions"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($clientes as $cliente): ?>
          <tr>
            <td><?= $this->Number->format($cliente->id_cliente) ?></td>
            <td><?= h($cliente->nome) ?></td>
            <td><?= h($cliente->cpf) ?></td>
            <td><?= h($cliente->endereco) ?></td>
            <td><?= h($cliente->email) ?></td>
            <td><?= h($cliente->telefone) ?></td>
            <td><?= h($cliente->created) ?></td>
            <td><?= h($cliente->modified) ?></td>
            <td><?= ($cliente->is_pendente) ? __('Sim') : __('Não') ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $cliente->id_cliente], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $cliente->id_cliente], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $cliente->id_cliente], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar {0}?', $cliente->nome)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator">
    <div class="mr-auto" style="font-size:.8rem">
    <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} clientes de {{count}} no total')) ?>    </div>

    <ul class="pagination pagination-sm">
      <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape'=>false]) ?>
    </ul>

  </div>
  <!-- /.card-footer -->
</div>
