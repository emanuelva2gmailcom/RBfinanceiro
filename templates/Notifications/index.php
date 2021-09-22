<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notification[]|\Cake\Collection\CollectionInterface $notifications
 */
?>

<?php $this->assign('title', __('Notifications') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Notifications',
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
      <?= $this->Html->link(__('New Notification'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
          <tr>
              <th><?= $this->Paginator->sort('id_notification') ?></th>
              <th><?= $this->Paginator->sort('title') ?></th>
              <th><?= $this->Paginator->sort('message') ?></th>
              <th><?= $this->Paginator->sort('data') ?></th>
              <th><?= $this->Paginator->sort('class') ?></th>
              <th><?= $this->Paginator->sort('created') ?></th>
              <th><?= $this->Paginator->sort('modify') ?></th>
              <th><?= $this->Paginator->sort('lancamento_id') ?></th>
              <th class="actions"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($notifications as $notification): ?>
          <tr>
            <td><?= $this->Number->format($notification->id_notification) ?></td>
            <td><?= h($notification->title) ?></td>
            <td><?= h($notification->message) ?></td>
            <td><?= h($notification->data) ?></td>
            <td><?= h($notification->class) ?></td>
            <td><?= h($notification->created) ?></td>
            <td><?= h($notification->modify) ?></td>
            <td><?= $notification->has('lancamento') ? $this->Html->link($notification->lancamento->tipo, ['controller' => 'Lancamentos', 'action' => 'view', $notification->lancamento->id_lancamento]) : '' ?></td>
            <td class="actions">
              <?= $this->Html->link(__('View'), ['action' => 'view', $notification->id_notification], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Html->link(__('Edit'), ['action' => 'edit', $notification->id_notification], ['class'=>'btn btn-xs btn-outline-primary', 'escape'=>false]) ?>
              <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $notification->id_notification], ['class'=>'btn btn-xs btn-outline-danger', 'escape'=>false, 'confirm' => __('Are you sure you want to delete # {0}?', $notification->id_notification)]) ?>
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
