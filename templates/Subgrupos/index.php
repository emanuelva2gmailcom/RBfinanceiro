<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subgrupo[]|\Cake\Collection\CollectionInterface $subgrupos
 */
?>

<?php $this->assign('title', __('Subgrupos') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Subgrupos',
    ]
  ])
);
?>

<div class="card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><!-- --></h2>
    <div class="card-toolbox">
      <?= $this->Paginator->limitControl([], null, [
            'label'=>false,
            'class' => 'form-control-sm',
          ]); ?>
      <?= $this->Html->link(__('New Subgrupo'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
              <th><?= $this->Paginator->sort('id_subgrupo') ?></th>
              <th><?= $this->Paginator->sort('subgrupo') ?></th>
              <th><?= $this->Paginator->sort('descricao') ?></th>
              <th><?= $this->Paginator->sort('created') ?></th>
              <th><?= $this->Paginator->sort('modified') ?></th>
              <th><?= $this->Paginator->sort('grupo_id') ?></th>
              <th class="actions"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($subgrupos as $subgrupo): ?>
          <tr>
            <td><?= $this->Number->format($subgrupo->id_subgrupo) ?></td>
            <td><?= h($subgrupo->subgrupo) ?></td>
            <td><?= h($subgrupo->descricao) ?></td>
            <td><?= h($subgrupo->created) ?></td>
            <td><?= h($subgrupo->modified) ?></td>
            <td><?= $subgrupo->has('grupo') ? $this->Html->link($subgrupo->grupo->id_grupo, ['controller' => 'Grupos', 'action' => 'view', $subgrupo->grupo->id_grupo]) : '' ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['action' => 'view', $subgrupo->id_subgrupo], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Edit'), ['action' => 'edit', $subgrupo->id_subgrupo], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $subgrupo->id_subgrupo], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $subgrupo->id_subgrupo)]) ?>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->

  <div class="card-footer d-md-flex paginator">
    <div class="mr-auto" style="font-size:.8rem">
      <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
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
