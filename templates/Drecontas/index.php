<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dreconta[]|\Cake\Collection\CollectionInterface $drecontas
 */
?>

<?php $this->assign('title', __('Drecontas') ); ?>

<div class="card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><!-- --></h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
          ]); ?>
      <?= $this->Html->link(__('Nova dreconta'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
              <th><?= $this->Paginator->sort('id_dreconta') ?></th>
              <th><?= $this->Paginator->sort('conta') ?></th>
              <th><?= $this->Paginator->sort('descrição') ?></th>
              <th><?= $this->Paginator->sort('created') ?></th>
              <th><?= $this->Paginator->sort('modified') ?></th>
              <th><?= $this->Paginator->sort('dregrupo_id') ?></th>
              <th class="actions"><?= __('Ações') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($drecontas as $dreconta): ?>
          <tr>
            <td><?= $this->Number->format($dreconta->id_dreconta) ?></td>
            <td><?= h($dreconta->conta) ?></td>
            <td><?= h($dreconta->descricao) ?></td>
            <td><?= h($dreconta->created) ?></td>
            <td><?= h($dreconta->modified) ?></td>
            <td><?= $dreconta->has('dregrupo') ? $this->Html->link($dreconta->dregrupo->id_dregrupo, ['controller' => 'Dregrupos', 'action' => 'view', $dreconta->dregrupo->id_dregrupo]) : '' ?></td>
            <td class="actions">
              <?= $this->Html->link(__('Vizualizar'), ['action' => 'view', $dreconta->id_dreconta], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Editar'), ['action' => 'edit', $dreconta->id_dreconta], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete', $dreconta->id_dreconta], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Você quer mesmo deletar {0}?', $dreconta->conta)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator">
    <div class="mr-auto" style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Pagina {{page}} de {{pages}}, mostrando {{current}} DRE contas de {{count}} no total')) ?>
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
