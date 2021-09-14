<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Comprovante[]|\Cake\Collection\CollectionInterface $comprovantes
 */
?>

<?php $this->assign('title', __('Comprovantes') ); ?>

<div class="card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><!-- --></h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
          ]); ?>
      <?= $this->Html->link(__('Novo Comprovante'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
              <th><?= $this->Paginator->sort('nome_arquivo') ?></th>
              <th><?= $this->Paginator->sort('tipo') ?></th>
              <th><?= $this->Paginator->sort('lancamento_id') ?></th>
              <th class="actions"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($comprovantes as $comprovante): ?>
          <tr>
            <td><?= h($comprovante->nome_arquivo) ?></td>
            <td><?= h($comprovante->tipo) ?></td>
            <td><?= $comprovante->has('lancamento') ? $this->Html->link($comprovante->lancamento->id_lancamento, ['controller' => 'Lancamentos', 'action' => 'view', $comprovante->lancamento->id_lancamento]) : '' ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $comprovante->id_comprovante], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $comprovante->id_comprovante], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $comprovante->id_comprovante], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar {0}?', $comprovante->nome_arquivo)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator">
    <div class="mr-auto" style="font-size:.8rem">
    <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} Comprovantes de {{count}} no total')) ?>
    </div>

    <ul class="pagination pagination-sm"
      <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->numbers() ?>
      <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape'=>false]) ?>
      <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape'=>false]) ?>
    </ul>

  </div>
  <!-- /.card-footer -->
</div>
