<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notification $notification
 */
?>

<?php
$this->assign('title', __('Notificação') );
?>

<div class="view card card-primary card-outline">
  <div class="card-header d-sm-flex">
    <h2 class="card-title"><?= h($notification->title) ?></h2>
  </div>
  <div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <tr>
            <th><?= __('Title') ?></th>
            <td><?= h($notification->title) ?></td>
        </tr>
        <tr>
            <th><?= __('Message') ?></th>
            <td><?= h($notification->message) ?></td>
        </tr>
        <tr>
            <th><?= __('Class') ?></th>
            <td><?= h($notification->class) ?></td>
        </tr>
        <tr>
            <th><?= __('Lancamento') ?></th>
            <td><?= $notification->has('lancamento') ? $this->Html->link($notification->lancamento->tipo, ['controller' => 'Lancamentos', 'action' => 'view', $notification->lancamento->id_lancamento]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id Notification') ?></th>
            <td><?= $this->Number->format($notification->id_notification) ?></td>
        </tr>
        <tr>
            <th><?= __('Data') ?></th>
            <td><?= h($notification->data) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($notification->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modify') ?></th>
            <td><?= h($notification->modify) ?></td>
        </tr>
    </table>
  </div>
  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Deletar'),
          ['action' => 'delete',  $notification->id_notification],
          ['confirm' => __('Você quer mesmo deletar {0}?',  $notification->title), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Html->link(__('Editar'), ['action' => 'edit',  $notification->id_notification], ['class' => 'btn btn-secondary']) ?>
      <?= $this->Html->link(__('Cancelar'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>
</div>


