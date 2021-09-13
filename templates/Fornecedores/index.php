<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fornecedore[]|\Cake\Collection\CollectionInterface $fornecedores
 */
?>

<?php $this->assign('title', __('Fornecedores') ); ?>



<div class="card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><!-- --></h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
          ]); ?>
      <?= $this->Html->link(__('Novo Fornecedor'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
              <th><?= $this->Paginator->sort('id_fornecedor') ?></th>
              <th><?= $this->Paginator->sort('nome') ?></th>
              <th><?= $this->Paginator->sort('cnpj') ?></th>
              <th><?= $this->Paginator->sort('responsavel') ?></th>
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
          <?php foreach ($fornecedores as $fornecedore): ?>
          <tr>
            <td><?= $this->Number->format($fornecedore->id_fornecedor) ?></td>
            <td><?= h($fornecedore->nome) ?></td>
            <td><?= h($fornecedore->cnpj) ?></td>
            <td><?= h($fornecedore->responsavel) ?></td>
            <td><?= h($fornecedore->endereco) ?></td>
            <td><?= h($fornecedore->email) ?></td>
            <td><?= h($fornecedore->telefone) ?></td>
            <td><?= h($fornecedore->created) ?></td>
            <td><?= h($fornecedore->modified) ?></td>
            <td><?= ($fornecedore->is_pendente) ? __('Sim') : __('Não') ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $fornecedore->id_fornecedor], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fornecedore->id_fornecedor], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fornecedore->id_fornecedor], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar o fonecedor {0}?', $fornecedore->nome)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator">
    <div class="mr-auto" style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} Fornecedores de {{count}} no total')) ?>
    </div>
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
