<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Cliente[]|\Cake\Collection\CollectionInterface $clientes
 */
?>

<?php $this->assign('title', __('Clientes') ); ?>

<style>
    .nm a{
        color: green;
    }
</style>

<div class="container-fluid d-flex align-items-center justify-content-center p-5">
    <div class="card container card-outline bg-white" style="border: green solid 2px; border-radius: 20px;">
        <div class="card-header d-sm-flex" style="padding-top: 50px;">
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
            'style' => 'color: #029BE1; border: 2px solid green;',
          ]); ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table text-nowrap">
        <thead class="nm">
        <tr style="color: green;">
              <th class="teste"><?= $this->Paginator->sort('Nome') ?></th>
              <th class="teste"><?= $this->Paginator->sort('CPF') ?></th>
              <th class="teste"><?= $this->Paginator->sort('Endereço') ?></th>
              <th class="teste"><?= $this->Paginator->sort('E-mail') ?></th>
              <th class="teste"><?= $this->Paginator->sort('Telefone') ?></th>
              <th class="teste"><?= $this->Paginator->sort('Is_Pendente') ?></th>
              <th class="actions teste"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($clientes as $cliente): ?>
            <tr style="color: #029BE1;">

            <td><?= h($cliente->nome) ?></td>
            <td><?= h($cliente->cpf) ?></td>
            <td><?= h($cliente->endereco) ?></td>
            <td><?= h($cliente->email) ?></td>
            <td><?= h($cliente->telefone) ?></td>
            <td><?= ($cliente->is_pendente) ? __('Sim') : __('Não') ?></td>
            <td class="actions">

              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $cliente->id_cliente], ['class'=>'btn btn-xs btn-outline-info', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $cliente->id_cliente], ['class'=>'btn btn-xs btn-outline-success', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $cliente->id_cliente], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar {0}?', $cliente->nome)]) ?>

            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator" style="color: green;">
    <div class="mr-auto" style="font-size:.8rem">
    <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} clientes de {{count}} no total')) ?>
</div>

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
          </div>
