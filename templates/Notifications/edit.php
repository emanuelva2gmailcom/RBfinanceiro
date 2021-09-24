<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Notification $notification
 */
?>

<?php $this->assign('title', __('Edit Notification') ); ?>

<?php
$this->assign('breadcrumb',
  $this->element('content/breadcrumb', [
    'home' => true,
    'breadcrumb' => [
      'List Notifications' => ['action'=>'index'],
      'View' => ['action'=>'view', $notification->id_notification],
      'Edit',
    ]
  ])
);
?>


<div class="card card-primary card-outline">
  <?= $this->Form->create($notification) ?>
  <div class="card-body">
    <?php
      echo $this->Form->control('title');
      echo $this->Form->control('message');
      echo $this->Form->control('data');
      echo $this->Form->control('class');
      echo $this->Form->control('modify');
      echo $this->Form->control('lancamento_id', ['options' => $lancamentos, 'empty' => true]);
    ?>
  </div>

  <div class="card-footer d-flex">
    <div class="">
      <?= $this->Form->postLink(
          __('Delete'),
          ['action' => 'delete', $notification->id_notification],
          ['confirm' => __('Are you sure you want to delete # {0}?', $notification->id_notification), 'class' => 'btn btn-danger']
      ) ?>
    </div>
    <div class="ml-auto">
      <?= $this->Form->button(__('Save')) ?>
      <?= $this->Html->link(__('Cancel'), ['action'=>'index'], ['class'=>'btn btn-default']) ?>
    </div>
  </div>

  <?= $this->Form->end() ?>
</div>
