<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fluxogrupo[]|\Cake\Collection\CollectionInterface $fluxogrupos
 */
?>

<?php $this->assign('title', __('Fluxogrupos') ); ?>

<div class="card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><!-- --></h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
          ]); ?>
      <?= $this->Html->link(__('Novo'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
              <th><?= $this->Paginator->sort('id_fluxogrupo') ?></th>
              <th><?= $this->Paginator->sort('grupo') ?></th>
              <th><?= $this->Paginator->sort('descrio') ?></th>
              <th><?= $this->Paginator->sort('created') ?></th>
              <th><?= $this->Paginator->sort('modified') ?></th>
              <th class="actions"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($fluxogrupos as $fluxogrupo): ?>
          <tr>
            <td><?= $this->Number->format($fluxogrupo->id_fluxogrupo) ?></td>
            <td><?= h($fluxogrupo->grupo) ?></td>
            <td><?= h($fluxogrupo->descricao) ?></td>
            <td><?= h($fluxogrupo->created) ?></td>
            <td><?= h($fluxogrupo->modified) ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $fluxogrupo->id_fluxogrupo], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $fluxogrupo->id_fluxogrupo], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $fluxogrupo->id_fluxogrupo], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você tem certeza sobre deletar "{0}"?', $fluxogrupo->grupo)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator">
    <div class="mr-auto" style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} fluxos grupos de {{count}} no total')) ?>
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
